<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;
use App\User;
class CheckPermissions
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role)
    {
        if (User::check_auth_user_permission($role)) {
            return $next($request);
        }else{
            return abort(404);
        }
    }

}