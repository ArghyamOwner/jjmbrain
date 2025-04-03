<?php

namespace App\Http\Livewire\StateDashboard;

use App\Enums\SchemeOperatingStatus;
use App\Enums\SchemeWorkStatus;
use App\Models\DivisionStat;
use App\Models\StateBfmStats;
use Carbon\Carbon;
use Livewire\Component;

class Cards extends Component
{
    public $stats = [];

    public function getStats()
    {
        $statsData = DivisionStat::query()
            ->whereDate('created_at', now())
            ->whereNotIn('key', ['tpi_upto_30', 'tpi_upto_50', 'tpi_upto_80', 'tpi_upto_90', 'tpi_above_90'])
            ->get();

        $this->stats = $statsData->groupBy('key')->map(function ($group) {
            return [
                'title' => $group->first()->name,
                'value' => $group->sum('value'),
                'link' => $this->getUrl($group->first()->key),
                'icon' => $group->first()->icon,
            ];
        })->values()->all();

        if ($statsData->isNotEmpty()) {
            $this->stats[] = [
                'title' => "Total Yesterday's BFM Readings",
                'value' => StateBfmStats::whereDate('stats_date', Carbon::yesterday()->toDateString())->pluck('flowmeter_schemes')->first(),
                'link' => route('divisionDashboard'),
                'icon' => '/img/icons/bfm.png',
            ];
        }
    }

    public function getUrl($key)
    {
        switch ($key) {
            case ('total_schemes'):
                return route('schemes', ['showType' => 'parent']);
                break;
            case ('completed_schemes'):
                return route('schemes', ['status' => SchemeWorkStatus::COMPLETED, 'showType' => 'parent']);
                break;
            case ('ongoing_schemes'):
                return route('schemes', ['status' => SchemeWorkStatus::ONGOING, 'showType' => 'parent']);
                break;
            case ('handedover_schemes'):
                return route('schemes', ['status' => SchemeWorkStatus::HANDED_OVER, 'showType' => 'parent']);
                break;
            case ('operative_schemes'):
                return route('schemes', ['operating_status' => SchemeOperatingStatus::OPERATIVE, 'showType' => 'parent']);
                break;
            case ('partially_operative_schemes'):
                return route('schemes', ['operating_status' => SchemeOperatingStatus::PARTIALLY_OPERATIVE, 'showType' => 'parent']);
                break;
            case ('non_operative_schemes'):
                return route('schemes', ['operating_status' => SchemeOperatingStatus::NON_OPERATIVE, 'showType' => 'parent']);
                break;
            case ('apdcl_no_updated'):
                return route('schemes', ['hasConsumerNo' => true, 'showType' => 'parent']);
                break;
            case ('jalmitra_with_schemes'):
                return route('jm.users', ['hasScheme' => 'yes', 'showType' => 'parent']);
                break;
            case ('jalmitra_without_scheme'):
                return route('jm.users', ['hasScheme' => 'no', 'status' => 'active', 'showType' => 'parent']);
                break;
            case ('geotag_schemes'):
                return route('schemes', ['hasLocation' => 'with', 'showType' => 'parent']);
                break;
            case ('lac_data_updated'):
                return route('schemes', ['hasLac' => true, 'showType' => 'parent']);
                break;
            case ('litholog_schemes'):
                return route('schemes', ['has_litholog' => 'yes', 'showType' => 'parent']);
                break;
            case ('pending_lithologs'):
                return route('lithologs', ['type' => 'pending']);
                break;
            case ('schemes_with_wuc'):
                return route('schemes', ['hasWuc' => 'yes', 'showType' => 'parent']);
                break;
            case ('planned_fhtc'):
                return '#';
                break;
            case ('achieved_fhtc'):
                return '#';
                break;
            case ('qr_installed'):
                return route('schemes', ['qrInstalled' => 'yes', 'showType' => 'parent']);
                break;
            case ('schemes_without_workorder'):
                return route('schemes', ['workorders' => 'no', 'showType' => 'parent']);
                break;
            case ('schemes_workorder_value_below_10k'):
                return route('schemes', ['woValueBelow10k' => true, 'showType' => 'parent']);
                break;
            case ('fully_tracked_schemes'):
                return route('schemes', ['tracking' => 'yes', 'showType' => 'parent']);
                break;
            case ('fhtc_mapped_schemes'):
                return route('schemes', ['fhtc' => 'yes', 'showType' => 'parent']);
                break;
            case ('without_tpi_progress'):
                return route('schemes', ['tpiProgress' => 'no', 'showType' => 'parent']);
                break;
            case ('imis_id_issue'):
                return route('schemes', ['imisIssue' => 'yes', 'showType' => 'parent']);
                break;
            case ('without_subdivision'):
                return route('schemes', ['without_subdivision' => 'yes', 'showType' => 'parent']);
                break;
            default:
        }
    }

    public function render()
    {
        return view('livewire.state-dashboard.cards');
    }
}
