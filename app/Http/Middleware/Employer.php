<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;
use Auth;

class Employer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('employer')) {
                $uriSegments = explode("/", parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
                if (request()->routeIs('employers.login')) {
                    return redirect(RouteServiceProvider::EMPLOYER);
                }
                if (Auth::user()->is_deactivated == 1) {
                    if (!@$uriSegments[2] == "deactivate-account") {
                        return redirect('/account-settings/deactivate-account')->with('warning', 'Please Activate Your Account To Continue');
                    }
                }
                return $next($request);

            } else {
                Auth::logout();
                return redirect()->back()->with('error', 'These credentials do not match our records.');
            }
        }
    }
}