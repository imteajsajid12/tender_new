<?php

namespace App\Services\TwoFactor;

use App\Models\OtpCode;
use App\Models\User;
use App\Mail\OtpMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

/**
 * OTP Service
 *
 * A reusable service class for generating, sending, and verifying OTP codes.
 * This service can be used across different Laravel projects for two-factor authentication.
 *
 * Usage:
 *   $otpService = app(OtpService::class);
 *   $otp = $otpService->generate($user, OtpCode::PURPOSE_LOGIN);
 *   $otpService->send($otp);
 *   $result = $otpService->verify($user->id, $code, OtpCode::PURPOSE_LOGIN);
 */
class OtpService
{
    /**
     * OTP length (number of digits)
     *
     * @var int
     */
    protected int $otpLength;

    /**
     * OTP expiry time in minutes
     *
     * @var int
     */
    protected int $expiryMinutes;

    /**
     * Maximum verification attempts
     *
     * @var int
     */
    protected int $maxAttempts;

    /**
     * Rate limit: Max OTPs per user per hour
     *
     * @var int
     */
    protected int $rateLimitPerHour;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->otpLength = config('twofactor.otp_length', 6);
        $this->expiryMinutes = config('twofactor.otp_expiry_minutes', 10);
        $this->maxAttempts = config('twofactor.max_attempts', 5);
        $this->rateLimitPerHour = config('twofactor.rate_limit_per_hour', 5);
    }

    /**
     * Generate a new OTP code for a user.
     *
     * @param User $user
     * @param string $purpose
     * @param Request|null $request
     * @return OtpCode|null
     * @throws Exception
     */
    public function generate(User $user, string $purpose = OtpCode::PURPOSE_LOGIN, ?Request $request = null): ?OtpCode
    {
        // Check rate limiting
        if ($this->isRateLimited($user->id)) {
            Log::warning("OTP rate limit exceeded for user: {$user->id}");
            throw new Exception('שלחת יותר מדי בקשות. אנא נסה שוב מאוחר יותר');
        }

        // Invalidate any existing valid OTPs for this purpose
        $this->invalidateExistingOtps($user->id, $purpose);

        // Generate new OTP code
        $otpCode = $this->generateCode();

        // Create OTP record
        $otp = OtpCode::create([
            'user_id' => $user->id,
            'email' => $user->email,
            'otp_code' => $otpCode,
            'purpose' => $purpose,
            'is_verified' => false,
            'expires_at' => Carbon::now()->addMinutes($this->expiryMinutes),
            'attempts' => 0,
            'ip_address' => $request?->ip(),
            'user_agent' => $request?->userAgent(),
        ]);

        Log::info("OTP generated for user: {$user->id}, purpose: {$purpose}");

        return $otp;
    }

    /**
     * Send OTP code via email.
     *
     * @param OtpCode $otp
     * @param string|null $customSubject
     * @param string|null $customTemplate
     * @return bool
     */
    public function send(OtpCode $otp, ?string $customSubject = null, ?string $customTemplate = null): bool
    {
        try {
            $subject = $customSubject ?? $this->getSubjectForPurpose($otp->purpose);
            $template = $customTemplate ?? config('twofactor.email_template', 'emails.otp');

            Mail::to($otp->email)->send(new OtpMail(
                otpCode: $otp->otp_code,
                purpose: $otp->purpose,
                expiryMinutes: $this->expiryMinutes,
                subject: $subject,
                template: $template,
                user: $otp->user
            ));

            Log::info("OTP email sent to: {$otp->email}");

            return true;
        } catch (Exception $e) {
            Log::error("Failed to send OTP email: {$e->getMessage()}", [
                'email' => $otp->email,
                'exception' => $e->getTraceAsString(),
            ]);
            return false;
        }
    }

    /**
     * Verify an OTP code.
     *
     * @param int $userId
     * @param string $code
     * @param string $purpose
     * @return array{success: bool, message: string, otp?: OtpCode}
     */
    public function verify(int $userId, string $code, string $purpose = OtpCode::PURPOSE_LOGIN): array
    {
        // Find the most recent valid OTP for this user and purpose
        $otp = OtpCode::forUser($userId)
                      ->forPurpose($purpose)
                      ->valid()
                      ->latest()
                      ->first();

        if (!$otp) {
            return [
                'success' => false,
                'message' => 'לא נמצא קוד אימות תקף. אנא בקש קוד חדש',
            ];
        }

        // Check if max attempts exceeded
        if ($otp->hasExceededMaxAttempts($this->maxAttempts)) {
            $otp->update(['is_verified' => true]); // Invalidate OTP
            return [
                'success' => false,
                'message' => 'חרגת ממספר הניסיונות המותר. אנא בקש קוד חדש',
            ];
        }

        // Check if OTP is expired
        if ($otp->isExpired()) {
            return [
                'success' => false,
                'message' => 'קוד האימות פג תוקף. אנא בקש קוד חדש',
            ];
        }

        // Verify the code
        if ($otp->otp_code !== $code) {
            $otp->incrementAttempts();
            $remainingAttempts = $this->maxAttempts - $otp->attempts;

            return [
                'success' => false,
                'message' => "קוד אימות שגוי. נותרו {$remainingAttempts} ניסיונות",
            ];
        }

        // Mark as verified
        $otp->markAsVerified();

        Log::info("OTP verified successfully for user: {$userId}, purpose: {$purpose}");

        return [
            'success' => true,
            'message' => 'האימות הצליח',
            'otp' => $otp,
        ];
    }

    /**
     * Generate OTP and send in one call.
     *
     * @param User $user
     * @param string $purpose
     * @param Request|null $request
     * @return array{success: bool, message: string}
     */
    public function generateAndSend(User $user, string $purpose = OtpCode::PURPOSE_LOGIN, ?Request $request = null): array
    {
        try {
            $otp = $this->generate($user, $purpose, $request);

            if (!$otp) {
                return [
                    'success' => false,
                    'message' => 'נכשלה יצירת קוד האימות. אנא נסה שוב',
                ];
            }

            $sent = $this->send($otp);

            if (!$sent) {
                return [
                    'success' => false,
                    'message' => 'נכשלה שליחת האימייל. אנא נסה שוב',
                ];
            }

            return [
                'success' => true,
                'message' => 'קוד אימות נשלח לאימייל שלך',
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'message' => $e->getMessage(),
            ];
        }
    }

    /**
     * Resend OTP code.
     *
     * @param int $userId
     * @param string $purpose
     * @param Request|null $request
     * @return array{success: bool, message: string}
     */
    public function resend(int $userId, string $purpose = OtpCode::PURPOSE_LOGIN, ?Request $request = null): array
    {
        $user = User::find($userId);

        if (!$user) {
            return [
                'success' => false,
                'message' => 'המשתמש לא נמצא',
            ];
        }

        return $this->generateAndSend($user, $purpose, $request);
    }

    /**
     * Check if user is rate limited.
     *
     * @param int $userId
     * @return bool
     */
    public function isRateLimited(int $userId): bool
    {
        $otpCount = OtpCode::forUser($userId)
                          ->where('created_at', '>=', Carbon::now()->subHour())
                          ->count();

        return $otpCount >= $this->rateLimitPerHour;
    }

    /**
     * Invalidate existing OTPs for a user and purpose.
     *
     * @param int $userId
     * @param string $purpose
     * @return void
     */
    public function invalidateExistingOtps(int $userId, string $purpose): void
    {
        OtpCode::forUser($userId)
               ->forPurpose($purpose)
               ->valid()
               ->update(['is_verified' => true]);
    }

    /**
     * Clean up expired OTP codes.
     *
     * @param int $olderThanDays
     * @return int Number of deleted records
     */
    public function cleanup(int $olderThanDays = 7): int
    {
        $deleted = OtpCode::where('created_at', '<', Carbon::now()->subDays($olderThanDays))
                         ->delete();

        Log::info("Cleaned up {$deleted} expired OTP records");

        return $deleted;
    }

    /**
     * Generate a random OTP code.
     *
     * @return string
     */
    protected function generateCode(): string
    {
        $min = pow(10, $this->otpLength - 1);
        $max = pow(10, $this->otpLength) - 1;

        return (string) random_int($min, $max);
    }

    /**
     * Get email subject based on purpose.
     *
     * @param string $purpose
     * @return string
     */
    protected function getSubjectForPurpose(string $purpose): string
    {
        return match ($purpose) {
            OtpCode::PURPOSE_LOGIN => config('twofactor.subjects.login', 'Your Login Verification Code'),
            OtpCode::PURPOSE_PASSWORD_RESET => config('twofactor.subjects.password_reset', 'Your Password Reset Code'),
            OtpCode::PURPOSE_EMAIL_VERIFY => config('twofactor.subjects.email_verify', 'Verify Your Email Address'),
            OtpCode::PURPOSE_TRANSACTION => config('twofactor.subjects.transaction', 'Transaction Verification Code'),
            default => config('twofactor.subjects.default', 'Your Verification Code'),
        };
    }

    /**
     * Get remaining time for OTP in seconds.
     *
     * @param int $userId
     * @param string $purpose
     * @return int|null
     */
    public function getRemainingTime(int $userId, string $purpose = OtpCode::PURPOSE_LOGIN): ?int
    {
        $otp = OtpCode::forUser($userId)
                      ->forPurpose($purpose)
                      ->valid()
                      ->latest()
                      ->first();

        if (!$otp) {
            return null;
        }

        return max(0, Carbon::now()->diffInSeconds($otp->expires_at, false));
    }
}
