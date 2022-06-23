<?php

namespace App\Services\Permissions\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckUserRoles
{

    /**
     * Handles an incoming request
     *
     * @param Request $request
     * @param Closure $next
     * @param string $roles
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string $roles) : mixed
    {
        if ($request->user()?->hasRoles($roles)) {
            return $next($request);
        }

        return abort(403);
    }

}
