<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Google2fa
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
        if ($request->user()?->google2fa_enabled) {
            if (!$request->session()->get('Google2faVerified')) {
                return redirect()->route('2fa.login');
            }
        }

        return $next($request);
    }

}
