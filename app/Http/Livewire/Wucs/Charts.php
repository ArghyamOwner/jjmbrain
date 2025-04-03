<?php

namespace App\Http\Livewire\Wucs;

use App\Models\District;
use App\Models\Scheme;
use App\Models\Wuc;
use App\Traits\WithFinancialYear;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Charts extends Component
{
    use WithFinancialYear;

    public function render()
    {
        $barChart1 = District::query()
            ->withCount(['wucs', 'handoverSchemes'])
            ->when(!(auth()->user()->isAdministrator() || auth()->user()->isStateIsa() || auth()->user()->isWucAuditor()), function ($q) {
                $q->whereIn('id', auth()->user()->districts->pluck('id'));
            })
            ->orderBy('name')
            ->get()
            ->map(fn($item) => [
                $item->name => [
                    'wucs' => $item->wucs_count,
                    'handoverSchemes' => $item->handover_schemes_count,
                ],
            ])->collapse();

        $barChart2 = District::query()
            ->withCount(['wucs', 'handoverSchemes'])
            ->when(!(auth()->user()->isAdministrator() || auth()->user()->isStateIsa() || auth()->user()->isWucAuditor()), function ($q) {
                $q->whereIn('id', auth()->user()->districts->pluck('id'));
            })
            ->orderBy('name');

        $wucLineChart = Wuc::query()
            ->select(
                DB::raw('MONTH(created_at) as month'),
                DB::raw('COUNT(*) as wucCount'),
            )
            ->whereBetween('created_at', [$this->financialYearStartDate(), $this->financialYearEndDate()])
            ->when(!(auth()->user()->isAdministrator() || auth()->user()->isStateIsa() || auth()->user()->isWucAuditor()), function ($q) {
                $q->whereIn('district_id', auth()->user()->districts->pluck('id'));
            })
            ->groupBy('month')
            ->pluck('wucCount', 'month')->all();

        $schemeLineChart = Scheme::query()
            ->select(
                DB::raw('MONTH(handover_date) as month'),
                DB::raw('COUNT(*) as schemeCount'),
            )
            ->whereBetween('handover_date', [$this->financialYearStartDate(), $this->financialYearEndDate()])
        // ->whereBetween('handover_date', ['2023-04-01', '2024-03-31'])
            ->when(!(auth()->user()->isAdministrator() || auth()->user()->isStateIsa() || auth()->user()->isWucAuditor()), function ($q) {
                $q->whereIn('district_id', auth()->user()->districts->pluck('id'));
            })
            ->groupBy('month')
            ->pluck('schemeCount', 'month')->all();

        foreach (config('jjm.financialYearMonths') as $key => $value) {
            $wucMatchingKeys[$value] = $wucLineChart[$key] ?? '';
            $schemeMatchingKeys[$value] = $schemeLineChart[$key] ?? '';
        }

        return view('livewire.wucs.charts', [
            'barChart1' => $barChart1,
            'labels' => array_values(config('jjm.financialYearMonths')),
            'wucLineChart' => $wucMatchingKeys,
            'schemeLineChart' => $schemeMatchingKeys,
            'handedOverCount' => $barChart2->pluck('handover_schemes_count', 'name')->all(),
            'wucCount' => $barChart2->pluck('wucs_count', 'name')->all(),
        ]);
    }
}
