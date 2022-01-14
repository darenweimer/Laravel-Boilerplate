<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class HasAnyPermission
{

    /**
     * Handles an incoming request
     *
     * @param Request $request
     * @param Closure $next
     * @param array $permissions
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, ...$permissions)
    {
        if ($user = $request->user()) {
            if ($user->hasAnyPermission($permissions)) {
                return $next($request);
            }
        }

        return abort(403);
    }

}
