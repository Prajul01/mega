<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (!$request->expectsJson()) {

            if (request()->routeIs('employers.*')) {
                if ($request->routeIs('employers.login')) {
                    return route('employers.login');
                }else{
                    return route('employers.login', ['redirect_to' => route($request->route()->getName())]);
                }
            }

            if (request()->routeIs('users.*')) {
                return to_route('users.dashboard');
            }

            return abort(404);

        }
    }
}