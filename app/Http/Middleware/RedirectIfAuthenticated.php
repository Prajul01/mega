<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @param  string|null  ...$guards
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, ...$guards)
    {
        $guards = empty($guards) ? [null] : $guards;
        if (Auth::check()) {
            if (Auth::user()->hasRole('super-admin')) {
                return redirect(RouteServiceProvider::HOME);
            }

            if(Auth::user()->hasRole('employer')) {
                return redirect(RouteServiceProvider::EMPLOYER);
            }

            if(Auth::user()->hasRole('job-seeker')){
                return redirect(RouteServiceProvider::JOB . '@' . Auth::user()->username);
            }
        }
        return $next($request);
    }
}
