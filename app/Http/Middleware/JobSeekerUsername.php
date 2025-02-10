<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class JobSeekerUsername
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
        if (auth()->user()->username === request()->route('username')) {
            return $next($request);
        }

        return to_route('index')->with('error', 'Something went wrong.');
    }
}