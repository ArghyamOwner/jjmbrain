<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthenticateTenant
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
        if (! $request->expectsJson()) {
            $pos = strpos($request->getHost(), config('app.tenant_domain'));

            if ($pos !== false && ! Auth::guard('web')->check()) {
                return redirect(route('tenant.login'));
            }
        }

        return $next($request);
    }
}
