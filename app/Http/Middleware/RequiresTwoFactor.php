<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Requires Two-Factor Middleware
 *
 * Ensures the user has a pending 2FA verification.
 * This middleware is used for the 2FA verification routes.
 *
 * Usage in routes:
 *   Route::middleware('twofactor.pending')->group(function () {
 *       Route::get('/2fa/verify', ...);
 *       Route::post('/2fa/verify', ...);
 *   });
 */
class RequiresTwoFactor
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
        // Check if there's a pending 2FA verification
        $userId = session(config('twofactor.session.user_id_key'));

        if (!$userId) {
            return redirect()->route('login')
                ->with('error', __('twofactor.session_expired'));
        }

        return $next($request);
    }
}
