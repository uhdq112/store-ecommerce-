<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if ($guard == 'admin')//    adminوديه لل روت admin شوف المستخدم اذ هو
                return redirect(RouteServiceProvider::ADMIN);
            else// مالم
                return redirect(RouteServiceProvider::HOME);//  HOMEوديه لل روت HOME شوف المستخدم اذ هو
        }

        return $next($request);
    }
}
