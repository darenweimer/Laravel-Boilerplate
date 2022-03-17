<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserPermissions
{

    /**
     * Handles an incoming request
     *
     * @param Request $request
     * @param Closure $next
     * @param string $permissions
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $permissions) : mixed
    {
        if ($request->user()?->permitted($permissions)) {
            return $next($request);
        }

        return abort(403);
    }

}
