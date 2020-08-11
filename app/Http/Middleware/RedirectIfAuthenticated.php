<?php

namespace App\Http\Middleware;

use Closure;

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
        if (auth($guard)->check()) {
            $guard = $guard !== null
                ? $guard
                : config('auth.defaults.guard');
            switch ($guard) {
                case GUARD_DASHBOARD:
                    return redirect(route('dashboard.home'));
            }
        }

        return $next($request);
    }
}
