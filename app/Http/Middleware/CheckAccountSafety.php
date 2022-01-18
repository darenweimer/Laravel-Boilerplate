<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckAccountSafety
{

    /**
     * Handles an incoming request
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (($user = $request->user()) && $user->compromised) {
            return abort(403);
        }

        return $next($request);
    }

}
