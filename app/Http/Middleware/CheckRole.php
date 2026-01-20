<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Route;
use Closure;

class CheckRole
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
        $role = explode('-', $role);
        if (in_array($request->user()->role, $role)) {
            return $next($request);
        }else{
            if ($request->user()->role == 4) {
               $url = $request->path();
               return redirect('/tk/'.$url);
            }
            return abort(404);
        }
        return $next($request);
    }

}