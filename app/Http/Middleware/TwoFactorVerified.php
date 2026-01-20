<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Two-Factor Verified Middleware
 *
 * Ensures the user has completed 2FA verification before accessing protected routes.
 * This middleware should be applied after the 'auth' middleware.
 *
 * Usage in routes:
 *   Route::middleware(['auth', 'twofactor.verified'])->group(function () {
 *       // Protected routes
 *   });
 *
 * Or in controller constructor:
 *   $this->middleware('twofactor.verified');
 */
class TwoFactorVerified
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if 2FA is enabled globally
        if (!config('twofactor.enabled', true)) {
            return $next($request);
        }

        // Check if user is authenticated
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Check if 2FA verification is pending
        $hasPendingVerification = session()->has(config('twofactor.session.user_id_key'));

        if ($hasPendingVerification) {
            return redirect()->route('2fa.verify');
        }

        // Check if 2FA was verified in this session
        $isVerified = session(config('twofactor.session.verified_key'), false);

        if (!$isVerified) {
            // User is authenticated but hasn't completed 2FA in this session
            // This shouldn't normally happen if the login flow is correct
            return redirect()->route('login')
                ->with('error', __('twofactor.session_expired'));
        }

        return $next($request);
    }
}
