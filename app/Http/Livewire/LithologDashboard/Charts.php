<?php

namespace App\Http\Livewire\LithologDashboard;

use App\Models\Division;
use App\Models\Lithology;
use App\Traits\WithFinancialYear;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Charts extends Component
{
    use WithFinancialYear;

    public function render()
    {
        $lithologyLineChart = Lithology::query()
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as lithologyCount'),
            )
            ->whereBetween('created_at', [$this->financialYearStartDate(), $this->financialYearEndDate()])
            ->groupBy('month')
            ->pluck('lithologyCount', 'month')->all();

        foreach (config('jjm.financialYearMonths') as $key => $value) {
            $lithologyMatchingKeys[$value] = $lithologyLineChart[$key] ?? '';
        }

        $divisionLithologs = Division::query()
            ->withCount(['lithologs', 'verifiedLithologs'])
            ->orderBy('name')->get();

        return view('livewire.litholog-dashboard.charts', [
            'labels' => array_values(config('jjm.financialYearMonths')),
            'lithologyLineChart' => $lithologyMatchingKeys,
            'completeLithologs' => $divisionLithologs->pluck('lithologs_count', 'name')->all(),
            'verifiedLithologs' => $divisionLithologs->pluck('verified_lithologs_count', 'name')->all()
        ]);
    }
}
