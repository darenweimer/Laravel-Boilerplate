<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserGroups
{

    /**
     * Handles an incoming request
     *
     * @param Request $request
     * @param Closure $next
     * @param string $groups
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $groups) : mixed
    {
        if ($request->user()?->grouped($groups)) {
            return $next($request);
        }

        return abort(403);
    }

}
