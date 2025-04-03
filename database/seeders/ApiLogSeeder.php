<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Jenssegers\Agent\Agent;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ApiLogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $routes = [
            'user-details',
            'create-post',
            'delete-post',
            'list-users',
            'get-user-profile',
            'update-settings',
            'fetch-notifications',
            'login',
            'logout',
        ];
        // Define some auth types for testing
        $authTypes = ['Bearer Token', 'None'];
        // Insert random data into the api_logs table
        foreach (range(1, 500) as $i) {
            $userAgent = fake()->userAgent();
            $agent = new Agent();
            $agent->setUserAgent($userAgent);
            // Extract platform and browser details
            $platform = $agent->platform(); // e.g., 'Windows', 'Mac OS', 'Linux', etc.
            $browser = $agent->browser(); // e.g., 'Chrome', 'Firefox', 'Safari', etc.
            // Optional: Get version information
            $platformVersion = $agent->version($platform);
            $browserVersion = $agent->version($browser);
            DB::table('api_logs')->insert([
                'id' => (string) Str::ulid(),
                'method' => ['GET', 'POST', 'PUT', 'DELETE'][array_rand(['GET', 'POST', 'PUT', 'DELETE'])],
                'url' => '/api/' . Str::random(10),
                'route_name' => $routes[array_rand($routes)],
                'status_code' => [200, 201, 204, 400, 401, 403, 404, 500][array_rand([200, 201, 204, 400, 401, 403, 404, 500])],
                'ip_address' => fake()->ipv4(),
                'user_agent' => $userAgent,
                'platform' => $platform,
                'platform_version' => $platformVersion,
                'browser' => $browser,
                'browser_version' => $browserVersion,
                'response_time' => fake()->numberBetween(50, 2000), // in milliseconds
                'response_size' => fake()->numberBetween(500, 50000), // in bytes
                'auth_type' => $authTypes[array_rand($authTypes)],
                'created_at' => now()->subDays(rand(0, 30)), // Random dates within the last 30 days
            ]);
        }
    }
}
// php artisan db:seed --class=ApiLogSeeder