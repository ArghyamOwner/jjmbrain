<?php

namespace App\Http\Livewire\PerformanceGuarantees;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\PerformanceGuarantee;

class Stats extends Component
{
    public $stats = [];

    public function getStats()
    {   
        // $pgQuery = PerformanceGuarantee::query();
        $totalPgAmount = PerformanceGuarantee::sum("pg_amount");
        $totalPgAmountExpiredThisMonth = PerformanceGuarantee::query()
                ->whereDate('expired_date', '<=', date('Y-m-d'))
                ->sum("pg_amount");
        $totalPgAmountExpired = PerformanceGuarantee::where('expired_date', '<=', today())->sum("pg_amount");

        $totalNumberOfPg = PerformanceGuarantee::count();
        $totalNumberOfPgExpired = PerformanceGuarantee::whereDate('expired_date', '<=', date('Y-m-d'))->count();
        $totalNumberOfPgWithdrawn = PerformanceGuarantee::whereNotNull('withdrawn_at')->count();

        $this->stats = [
            'Total PG Amount' => Str::money($totalPgAmount),
            'Total PG Amount Expired This Month' => Str::money($totalPgAmountExpiredThisMonth),
            'Total PG Amount Expired' => Str::money($totalPgAmountExpired),
            'Number of PG' => $totalNumberOfPg,
            'Total PG Expired' => $totalNumberOfPgExpired,
            'Number of PG Withdrawn' => $totalNumberOfPgWithdrawn
        ];
    }
    
    public function render()
    {
        return view('livewire.performance-guarantees.stats');
    }
}
