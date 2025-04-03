<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use Jenssegers\Agent\Agent;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Str;

class LogApiRequests
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Start time
        $start = microtime(true);
        // Proceed with the request
        $response = $next($request);
        // Calculate response time
        $duration = microtime(true) - $start;
        $agent = new Agent();
        $agent->setUserAgent($request->header('User-Agent'));
        // Get platform and browser
        $platform = $agent->platform() ?? 'Unknown'; // e.g., 'Windows', 'Mac OS', 'Linux', etc.
        $browser = $agent->browser() ?? 'Unknown'; // e.g., 'Chrome', 'Firefox', 'Safari', etc.
        // Optional: Get version information
        $platformVersion = $agent->version($platform);
        $browserVersion = $agent->version($browser);
        // Save to database
        DB::table('api_logs')->insert([
            'id' => (string) Str::ulid(),
            'method' => $request->method(),
            'url' => $request->url(), // $request->fullUrl()
            'route_name' => Route::currentRouteName() ?? 'undefined',
            'status_code' => $response->getStatusCode(),
            'ip_address' => $request->ip(),
            'user_agent' => $request->userAgent(), // $request->header('UserAgent'),
            'response_time' => (int) $duration * 1000, // in milliseconds
            'response_size' => strlen($response->getContent()), // in bytes
            'auth_type' => $request->header('Authorization') ? 'Bearer Token' : 'None',
            'user_id' => auth()->check() ? auth()->id() : null,
            'platform' => $platform,
            'platform_version' => $platformVersion,
            'browser' => $browser,
            'browser_version' => $browserVersion,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return $response;
    }
}
