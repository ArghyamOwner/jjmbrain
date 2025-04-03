<?php

namespace App\Http\Middleware;

use App\Facades\Permission;
use Closure;
use Illuminate\Http\Request;

class PermissionMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next, string $permission)
    {
        $permissions = explode('|', $permission);

        if (count($permissions) === 1 && ! $request->user()->hasPermission($permissions[0])) {
            abort(403);
        }

        if (count($permissions) > 1 && ! $request->user()->hasAnyPermissions($permissions)) {
            abort(403);
        }

        return $next($request);
    }
}
