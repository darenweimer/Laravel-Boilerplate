<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;

class Authenticate extends Middleware
{

    /**
     * Gets the path the user should be redirected to when not authenticated
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return string|void
     */
    protected function redirectTo($request) : string|void
    {
        if (!$request->expectsJson()) {
            return route('login');
        }
    }

}
