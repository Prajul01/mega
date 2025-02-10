<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Admin
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
        if (auth()->check()) {

            if(auth()->user()->suspended == 1){
                auth()->logout();
                return to_route('login')->with('error', 'Your account has been suspended');
            }
            if (auth()->user()->admin == 1) {
                return $next($request);
            }
            return abort(404);
        }
    }
}
