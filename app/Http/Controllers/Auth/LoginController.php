<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Auth\TwoFactorController;
use App\Models\OtpCode;
use App\Services\TwoFactor\OtpService;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    | Two-Factor Authentication has been integrated into the login flow.
    | After successful credential verification, users receive an OTP via email.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

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
     * @return void
     */
    public function __construct(OtpService $otpService)
    {
        $this->middleware('guest')->except('logout');
        $this->otpService = $otpService;
    }

    /**
     * Get the needed authorization credentials from the request.
     *
     * @param Request $request
     * @return array
     */
    protected function credentials(Request $request)
    {
        return [
            'email' => $request->{$this->username()},
            'password' => $request->password,
            'status' => 1
        ];
    }

    /**
     * The user has been authenticated.
     *
     * This method is called after successful credential verification.
     * We override it to implement 2FA flow.
     *
     * @param Request $request
     * @param mixed $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        // Check if 2FA is enabled and user should not bypass it
        if (config('twofactor.enabled', true) && !TwoFactorController::shouldBypass2FA($request, $user)) {
            // Log successful credential verification (2FA pending)
            security_log('INFO', 'LOGIN_ATTEMPT', [
                'user' => "user_{$user->id}",
                'ip' => $request->ip(),
                'success' => 'true',
                'status' => '2FA_PENDING',
            ]);

            // Logout the user without invalidating the session
            $this->guard()->logout();

            // Store user ID in session for 2FA verification
            session()->put(config('twofactor.session.user_id_key'), $user->id);

            // Regenerate session token to ensure fresh CSRF token
            $request->session()->regenerateToken();

            // Generate and send OTP
            $result = $this->otpService->generateAndSend($user, OtpCode::PURPOSE_LOGIN, $request);

            if (!$result['success']) {
                // Clear the session and show error
                session()->forget(config('twofactor.session.user_id_key'));

                Log::error("Failed to send 2FA OTP for user: {$user->id}");

                return redirect()->route('login')
                    ->with('error', $result['message']);
            }

            Log::info("2FA OTP sent for user: {$user->id}");

            // Save session explicitly before redirect
            session()->save();

            // Redirect to 2FA verification page
            return redirect()->route('2fa.verify')
                ->with('success', 'קוד אימות נשלח לאימייל שלך');
        }

        // 2FA bypassed - mark as verified and continue normal login
        session([config('twofactor.session.verified_key') => true]);
        session([config('twofactor.session.timestamp_key') => Carbon::now()->timestamp]);

        // Log successful login (2FA bypassed)
        security_log('INFO', 'LOGIN_SUCCESS', [
            'user' => "user_{$user->id}",
            'ip' => $request->ip(),
            'success' => 'true',
            'method' => '2FA_BYPASSED',
        ]);

        Log::info("User {$user->id} logged in (2FA bypassed)");

        // Return null to continue with default redirect
        return null;
    }

    /**
     * Get the failed login response instance.
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function sendFailedLoginResponse(Request $request)
    {
        // Log failed login attempt
        security_log('WARN', 'LOGIN_ATTEMPT', [
            'user' => $this->sanitizeEmail($request->input($this->username(), 'unknown')),
            'ip' => $request->ip(),
            'success' => 'false',
            'reason' => 'INVALID_CREDENTIALS',
        ]);

        throw \Illuminate\Validation\ValidationException::withMessages([
            $this->username() => [trans('auth.failed')],
        ]);
    }

    /**
     * Sanitize email for logging.
     *
     * @param string $email
     * @return string
     */
    protected function sanitizeEmail(string $email): string
    {
        $sanitized = preg_replace('/[^a-zA-Z0-9@._-]/', '', $email);
        return substr($sanitized, 0, 50) ?: 'unknown';
    }

    /**
     * Log the user out of the application.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(Request $request)
    {
        // Get user info before logout for logging
        $user = Auth::user();
        $userId = $user ? $user->id : 'unknown';

        // Log logout action
        security_log('INFO', 'LOGOUT', [
            'user' => "user_{$userId}",
            'ip' => $request->ip(),
        ]);

        // Clear 2FA session data
        session()->forget([
            config('twofactor.session.user_id_key'),
            config('twofactor.session.verified_key'),
            config('twofactor.session.timestamp_key'),
        ]);

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/login');
    }
}
