<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DatabaseTransaction
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
        if (!in_array($request->method(), ['POST','PUT','PATCH','DELETE'])) {
            return $next($request);
        }

        DB::beginTransaction();

        try {
            $response = $next($request);
        } catch (\Exception $e) {
            DB::rollBack();

            throw $e;
        }
    
        if ($response->getStatusCode() > 399) {
            DB::rollBack();
        } else {
            DB::commit();
        }

        return $response;
    }
}
