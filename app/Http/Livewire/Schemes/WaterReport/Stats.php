<?php

namespace App\Http\Livewire\Schemes\WaterReport;

use App\Models\WaterReport;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Stats extends Component
{
    public $stats = [];

    public function getStats()
    {
        $user = auth()->user();
        $stats = WaterReport::query()
            ->when($user->isSectionOfficer(), fn($query) => $query->where('user_id', Auth::id()))
            ->when(
                $user->isSdo() || $user->isExecutiveEngineer(),
                fn($query) =>
                $query->whereHas(
                    'scheme',
                    fn($query) =>
                    $query->whereIn('division_id', $user->divisions()->pluck('division_id'))
                )
            )
            ->selectRaw("count(*) as water_report")
            ->selectRaw("count(case when reasons_disruption = 'technical_issues_with_pwss' then 1 end) as technical_issues_with_pwss")
            ->selectRaw("count(case when reasons_disruption = 'administrative_issues' then 1 end) as administrative_issues")
            ->selectRaw("count(case when reasons_disruption = 'institutional_issues' then 1 end) as institutional_issues")
            ->selectRaw("count(case when reasons_disruption = 'technical_issues_with_apdcl' then 1 end) as technical_issues_with_apdcl")
            ->selectRaw("count(case when status = 'resolved' then 1 end) as resolved")
            ->selectRaw("count(case when status = 'pending' then 1 end) as pending")
            ->selectRaw("count(case when status = 'approved' then 1 end) as approved_pending")
            ->first(); 
            
        $this->stats = [
            'Total Number of Water Disruption' => [
                'value' => $stats->water_report,
                'icon' => 'svg/nowater.svg'
            ],
            'Total Number of Pending Water Disruption' => [
                'value' => $stats->pending,
                'icon' => 'svg/pending.svg'
            ],
            'Total Number of Approved Pending Water Disruption' => [
                'value' => $stats->approved_pending,
                'icon' => 'svg/work-pending.svg'
            ],
            'Total Number of Resolved Disruption' => [
                'value' => $stats->resolved,
                'icon' => 'svg/approved.svg'
            ],
            'Total Number of Technical Issues With PWSS' => [
                'value' => $stats->technical_issues_with_pwss,
                'icon' => 'svg/repair.svg'
            ],
            'Total Number of Administrative Issues' => [
                'value' => $stats->administrative_issues,
                'icon' => 'svg/man.svg'
            ],
            'Total Number of Institutional Issues' => [
                'value' => $stats->institutional_issues,
                'icon' => 'svg/water_house.svg'
            ],
            'Total Number of Technical Issues With APDCL' => [
                'value' => $stats->technical_issues_with_apdcl,
                'icon' => 'svg/water_disruption.svg'
            ],
        ];
    }

    public function render()
    {
        return view('livewire.schemes.water-report.stats');
    }
}
