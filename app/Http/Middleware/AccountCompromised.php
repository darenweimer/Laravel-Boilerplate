<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AccountCompromised
{
    /**
     * Handles an incoming request
     *
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next): mixed
    {
        if ($request->user()?->compromised) {
            return abort(403);
        }

        return $next($request);
    }
}
