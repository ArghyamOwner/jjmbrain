<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Tenant;
use Illuminate\Http\Request;

class CheckTenantToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $tenant = Tenant::findOrFail(auth()->user()->tenant_id);

        if ($request->bearerToken() !== $tenant->api_token) {
            return response()->json('Invalid token.');
        }

        return $next($request);
    }
}
