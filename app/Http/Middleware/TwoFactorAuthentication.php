<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class TwoFactorAuthentication
{

    /**
     * Handles an incoming request
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next) : mixed
    {
        if ($request->user()?->two_factor_enabled) {
            if (!$request->session()->get('two_factor_verified')) {
                return redirect()->guest('verify-2fa');
            }
        }

        return $next($request);
    }

}
