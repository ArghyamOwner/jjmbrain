<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\Livewire;

class ApiLogStats extends Component
{
    public $filter = 'today'; // Default filter
    public $totalRequests;
    public $successRate;
    public $averageResponseTime;
    public $topEndpoints = [];
    public $mostActiveUsers = [];
    public $platformStats = [];
    public $browserStats = [];

    public function mount()
    {
        $this->loadStats();
    }
    public function updatedFilter()
    {
        $this->loadStats(); // Reload stats when the filter changes
    }
    public function loadStats()
    {
        $query = DB::table('api_logs');
        // Apply filter based on the selected time period using match
        $query = match ($this->filter) {
            'today' => $query->whereDate('api_logs.created_at', Carbon::today()),
            'yesterday' => $query->whereDate('api_logs.created_at', Carbon::yesterday()),
            'last_7_days' => $query->whereBetween('api_logs.created_at', [Carbon::now()->subDays(7), Carbon::now()]),
            'last_10_days' => $query->whereBetween('api_logs.created_at', [Carbon::now()->subDays(10), Carbon::now()]),
            'last_30_days' => $query->whereBetween('api_logs.created_at', [Carbon::now()->subDays(30), Carbon::now()]),
            'last_60_days' => $query->whereBetween('api_logs.created_at', [Carbon::now()->subDays(60), Carbon::now()]),
            'last_90_days' => $query->whereBetween('api_logs.created_at', [Carbon::now()->subDays(90), Carbon::now()]),
            default => $query,
        };
        // Total requests
        $this->totalRequests = $query->count();
        // Success vs failure rate
        $successful = (clone $query)->where('status_code', '<', 400)->count();
        $this->successRate = $this->totalRequests > 0
            ? round(($successful / $this->totalRequests) * 100, 2)
            : 0;
        // Average response time
        $this->averageResponseTime = round($query->avg('response_time'), 2);
        // Top accessed endpoints
        $this->topEndpoints = $query
            ->clone()
            ->select('route_name', 'method', DB::raw('COUNT(*) as hit_count'))
            ->groupBy('route_name', 'method')
            ->orderBy(DB::raw('COUNT(*)'), 'desc')
            ->take(8)
            ->get()
            ->toArray();
        // Platform & Browser Stats
        $this->platformStats = $query
            ->clone()
            ->select('platform', DB::raw('COUNT(*) as count'))
            ->groupBy('platform')
            ->orderByDesc(DB::raw('COUNT(*)'))
            ->take(5)
            ->get();
        $this->browserStats = $query
            ->clone()
            ->select('browser', DB::raw('COUNT(*) as browser_count'))
            ->groupBy('browser')
            ->orderByDesc(DB::raw('COUNT(*)'))
            ->take(5)
            ->get();
        // Most active user
        $this->mostActiveUsers = $query
            ->clone()
            ->join('users', 'api_logs.user_id', '=', 'users.id')
            ->select('users.name', DB::raw('COUNT(api_logs.id) as hit_count'))
            ->whereNotNull('user_id')
            ->groupBy('users.name')
            ->orderBy(DB::raw('COUNT(api_logs.id)'), 'desc')
            ->take(5)
            ->get();
        if (Livewire::isLivewireRequest()) {
            $this->emit('chart-update-topendpoints', $this->topEndpoints);
        }
    }

    public function render()
    {
        return view('livewire.api-log-stats');
    }
}
