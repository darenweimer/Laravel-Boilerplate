<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserPermissionsCheck
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
        if ($request->user()?->hasPermissions($permissions)) {
            return $next($request);
        }

        return abort(403);
    }

}
