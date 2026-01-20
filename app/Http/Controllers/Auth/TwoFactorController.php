<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\OtpCode;
use App\Models\User;
use App\Services\TwoFactor\OtpService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;
use Carbon\Carbon;

/**
 * Two-Factor Authentication Controller
 *
 * Handles OTP verification during the login flow.
 * This controller is designed to be reusable across different Laravel projects.
 */
class TwoFactorController extends Controller
{
    /**
     * OTP Service instance.
     *
     * @var OtpService
     */
    protected OtpService $otpService;

    /**
     * Create a new controller instance.
     *
     * @param OtpService $otpService
     */
    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Show the OTP verification form.
     *
     * @param Request $request
     * @return View|RedirectResponse
     */
    public function showVerifyForm(Request $request): View|RedirectResponse
    {
        // Check if user has pending 2FA verification
        $userId = session(config('twofactor.session.user_id_key'));

        if (!$userId) {
            return redirect()->route('login')
                ->with('error', 'הפעלה פגה תוקף. אנא התחבר מחדש');
        }

        $user = User::find($userId);

        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'המשתמש לא נמצא');
        }

        // Get remaining time for current OTP
        $remainingTime = $this->otpService->getRemainingTime($userId, OtpCode::PURPOSE_LOGIN);

        // Calculate resend cooldown
        $lastOtp = OtpCode::forUser($userId)
                         ->forPurpose(OtpCode::PURPOSE_LOGIN)
                         ->latest()
                         ->first();

        $canResend = true;
        $resendCooldown = 0;

        if ($lastOtp) {
            $cooldownSeconds = config('twofactor.resend_cooldown_seconds', 60);
            $timeSinceLastOtp = Carbon::now()->diffInSeconds($lastOtp->created_at);

            if ($timeSinceLastOtp < $cooldownSeconds) {
                $canResend = false;
                $resendCooldown = $cooldownSeconds - $timeSinceLastOtp;
            }
        }

        return view('auth.two-factor-verify', [
            'user' => $user,
            'email' => $this->maskEmail($user->email),
            'remainingTime' => $remainingTime,
            'canResend' => $canResend,
            'resendCooldown' => $resendCooldown,
            'expiryMinutes' => config('twofactor.otp_expiry_minutes', 10),
            'rememberDeviceEnabled' => config('twofactor.remember_device.enabled', true),
            'rememberDays' => config('twofactor.remember_device.days', 30),
        ]);
    }

    /**
     * Verify the OTP code.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function verify(Request $request): RedirectResponse|JsonResponse
    {
        $request->validate([
            'otp_code' => 'required|string|size:' . config('twofactor.otp_length', 6),
            'remember_device' => 'nullable|boolean',
        ]);

        $userId = session(config('twofactor.session.user_id_key'));

        if (!$userId) {
            return $this->failedResponse($request, 'הפעלה פגה תוקף. אנא התחבר מחדש', 'login');
        }

        $user = User::find($userId);

        if (!$user) {
            return $this->failedResponse($request, 'המשתמש לא נמצא', 'login');
        }

        // Verify the OTP
        $result = $this->otpService->verify(
            $userId,
            $request->input('otp_code'),
            OtpCode::PURPOSE_LOGIN
        );

        if (!$result['success']) {
            Log::warning("Failed 2FA verification attempt for user: {$userId}");

            // Log failed 2FA attempt
            security_log('WARN', '2FA_VERIFY', [
                'user' => "user_{$userId}",
                'ip' => $request->ip(),
                'success' => 'false',
                'reason' => 'INVALID_OTP',
            ]);

            return $this->failedResponse($request, $result['message']);
        }

        // Clear 2FA session data
        $this->clearTwoFactorSession($request);

        // Mark 2FA as verified in session
        session([config('twofactor.session.verified_key') => true]);
        session([config('twofactor.session.timestamp_key') => Carbon::now()->timestamp]);

        // Login the user
        Auth::loginUsingId($userId, $request->filled('remember'));

        // Log successful login after 2FA
        security_log('INFO', 'LOGIN_SUCCESS', [
            'user' => "user_{$userId}",
            'ip' => $request->ip(),
            'success' => 'true',
            'method' => '2FA_VERIFIED',
        ]);

        Log::info("User {$userId} completed 2FA verification successfully");

        // Handle remember device
        $response = $this->successResponse(
            $request,
            'התחברת בהצלחה',
            config('twofactor.redirects.after_verification', '/admin')
        );

        // Set trusted device cookie if requested
        if ($request->boolean('remember_device') && config('twofactor.remember_device.enabled')) {
            $response = $this->setTrustedDeviceCookie($response, $user);
        }

        return $response;
    }

    /**
     * Resend OTP code.
     *
     * @param Request $request
     * @return RedirectResponse|JsonResponse
     */
    public function resend(Request $request): RedirectResponse|JsonResponse
    {
        $userId = session(config('twofactor.session.user_id_key'));

        if (!$userId) {
            return $this->failedResponse($request, 'הפעלה פגה תוקף. אנא התחבר מחדש', 'login');
        }

        $user = User::find($userId);

        if (!$user) {
            return $this->failedResponse($request, 'המשתמש לא נמצא', 'login');
        }

        // Check resend cooldown
        $lastOtp = OtpCode::forUser($userId)
                         ->forPurpose(OtpCode::PURPOSE_LOGIN)
                         ->latest()
                         ->first();

        if ($lastOtp) {
            $cooldownSeconds = config('twofactor.resend_cooldown_seconds', 60);
            $timeSinceLastOtp = Carbon::now()->diffInSeconds($lastOtp->created_at);

            if ($timeSinceLastOtp < $cooldownSeconds) {
                $remainingCooldown = $cooldownSeconds - $timeSinceLastOtp;
                return $this->failedResponse(
                    $request,
                    "אנא המתן {$remainingCooldown} שניות לפני שליחה מחדש"
                );
            }
        }

        // Generate and send new OTP
        $result = $this->otpService->generateAndSend($user, OtpCode::PURPOSE_LOGIN, $request);

        if (!$result['success']) {
            return $this->failedResponse($request, $result['message']);
        }

        Log::info("OTP resent for user: {$userId}");

        return $this->successResponse($request, 'קוד אימות נשלח לאימייל שלך');
    }

    /**
     * Cancel 2FA verification and return to login.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function cancel(Request $request): RedirectResponse
    {
        $userId = session(config('twofactor.session.user_id_key'));

        // Log 2FA cancellation
        if ($userId) {
            security_log('INFO', '2FA_CANCELLED', [
                'user' => "user_{$userId}",
                'ip' => $request->ip(),
            ]);
        }

        $this->clearTwoFactorSession($request);

        return redirect()->route('login')
            ->with('info', 'האימות בוטל');
    }

    /**
     * Check if the current device is trusted.
     *
     * @param Request $request
     * @param User $user
     * @return bool
     */
    public static function isTrustedDevice(Request $request, User $user): bool
    {
        if (!config('twofactor.remember_device.enabled')) {
            return false;
        }

        $cookieName = config('twofactor.remember_device.cookie_name');
        $cookieValue = $request->cookie($cookieName);

        if (!$cookieValue) {
            return false;
        }

        // Decode and verify the cookie
        try {
            $data = json_decode(decrypt($cookieValue), true);

            if (!$data || !isset($data['user_id'], $data['expires_at'])) {
                return false;
            }

            // Check if cookie belongs to this user
            if ($data['user_id'] !== $user->id) {
                return false;
            }

            // Check if cookie has expired
            if (Carbon::parse($data['expires_at'])->isPast()) {
                return false;
            }

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    /**
     * Check if user should bypass 2FA.
     *
     * @param Request $request
     * @param User $user
     * @return bool
     */
    public static function shouldBypass2FA(Request $request, User $user): bool
    {
        // Check if 2FA is enabled
        if (!config('twofactor.enabled', true)) {
            return true;
        }

        // Check if user's role is exempt
        $exemptRoles = config('twofactor.exempt_roles', []);
        if (!empty($exemptRoles) && in_array($user->role, $exemptRoles)) {
            return true;
        }

        // Check IP whitelist
        $ipWhitelist = config('twofactor.ip_whitelist', []);
        if (!empty($ipWhitelist) && in_array($request->ip(), $ipWhitelist)) {
            return true;
        }

        // Check trusted device
        if (self::isTrustedDevice($request, $user)) {
            return true;
        }

        return false;
    }

    /**
     * Mask email address for display.
     *
     * @param string $email
     * @return string
     */
    protected function maskEmail(string $email): string
    {
        $parts = explode('@', $email);

        if (count($parts) !== 2) {
            return $email;
        }

        $name = $parts[0];
        $domain = $parts[1];

        if (strlen($name) <= 2) {
            $maskedName = str_repeat('*', strlen($name));
        } else {
            $maskedName = substr($name, 0, 2) . str_repeat('*', strlen($name) - 2);
        }

        return $maskedName . '@' . $domain;
    }

    /**
     * Clear 2FA session data.
     *
     * @param Request $request
     * @return void
     */
    protected function clearTwoFactorSession(Request $request): void
    {
        session()->forget([
            config('twofactor.session.user_id_key'),
        ]);
    }

    /**
     * Set trusted device cookie.
     *
     * @param mixed $response
     * @param User $user
     * @return mixed
     */
    protected function setTrustedDeviceCookie($response, User $user)
    {
        $days = config('twofactor.remember_device.days', 30);
        $cookieName = config('twofactor.remember_device.cookie_name');

        $cookieData = encrypt(json_encode([
            'user_id' => $user->id,
            'created_at' => Carbon::now()->toIso8601String(),
            'expires_at' => Carbon::now()->addDays($days)->toIso8601String(),
        ]));

        $cookie = Cookie::make(
            $cookieName,
            $cookieData,
            $days * 24 * 60, // Convert days to minutes
            '/',
            null,
            true, // Secure
            true  // HttpOnly
        );

        if ($response instanceof RedirectResponse) {
            return $response->withCookie($cookie);
        }

        return $response;
    }

    /**
     * Return a success response (JSON or redirect based on request type).
     *
     * @param Request $request
     * @param string $message
     * @param string|null $redirectUrl
     * @return RedirectResponse|JsonResponse
     */
    protected function successResponse(Request $request, string $message, ?string $redirectUrl = null): RedirectResponse|JsonResponse
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => true,
                'message' => $message,
                'redirect' => $redirectUrl,
            ]);
        }

        if ($redirectUrl) {
            return redirect($redirectUrl)->with('success', $message);
        }

        return back()->with('success', $message);
    }

    /**
     * Return a failed response (JSON or redirect based on request type).
     *
     * @param Request $request
     * @param string $message
     * @param string|null $route
     * @return RedirectResponse|JsonResponse
     */
    protected function failedResponse(Request $request, string $message, ?string $route = null): RedirectResponse|JsonResponse
    {
        if ($request->expectsJson()) {
            return response()->json([
                'success' => false,
                'message' => $message,
            ], 422);
        }

        if ($route) {
            return redirect()->route($route)->with('error', $message);
        }

        return back()->withErrors(['otp_code' => $message]);
    }
}
