<?php

namespace App\Http\Livewire\DivisionDashboard;

use App\Enums\SchemeOperatingStatus;
use App\Enums\SchemeWorkStatus;
use App\Models\DivisionBfmStats;
use App\Models\DivisionStat;
use App\Models\StateBfmStats;
use Carbon\Carbon;
use Livewire\Component;

class Cards extends Component
{
    public $divisionId;
    public $stats = [];

    public function mount($division)
    {
        $this->divisionId = $division;
    }

    public function getStats()
    {
        $statsData = DivisionStat::query()
            ->whereDate('created_at', now())
            ->where('division_id', $this->divisionId)
            ->get();

        foreach ($statsData as $stat) {
            switch ($stat->key) {
                case ('total_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('completed_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'status' => SchemeWorkStatus::COMPLETED, 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('ongoing_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'status' => SchemeWorkStatus::ONGOING, 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('handedover_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'status' => SchemeWorkStatus::HANDED_OVER, 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('operative_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'operating_status' => SchemeOperatingStatus::OPERATIVE, 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('partially_operative_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'operating_status' => SchemeOperatingStatus::PARTIALLY_OPERATIVE, 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('non_operative_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'operating_status' => SchemeOperatingStatus::NON_OPERATIVE, 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('apdcl_no_updated'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'hasConsumerNo' => true, 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('jalmitra_with_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('jm.users', ['division' => $this->divisionId, 'hasScheme' => 'yes', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('jalmitra_without_scheme'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('jm.users', ['division' => $this->divisionId, 'hasScheme' => 'no', 'status' => 'active', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('geotag_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'hasLocation' => 'with', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('lac_data_updated'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'hasLac' => true, 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('litholog_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'has_litholog' => 'yes', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('pending_lithologs'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('lithologs', ['division' => $this->divisionId, 'type' => 'pending']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('schemes_with_wuc'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'hasWuc' => 'yes', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('planned_fhtc'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => '#',
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('achieved_fhtc'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => '#',
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('qr_installed'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'qrInstalled' => 'yes', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('schemes_without_workorder'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'workorders' => 'no', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('schemes_workorder_value_below_10k'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'woValueBelow10k' => true, 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('fully_tracked_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'tracking' => 'yes', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('fhtc_mapped_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'fhtc' => 'yes', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('without_tpi_progress'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'no', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                // case ('tpi_upto_30'):
                //     $this->stats[] = [
                //         'title' => $stat->name,
                //         'value' => (int) $stat->value ?? 0,
                //         'link' => route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'upto_30']),
                //         'icon' => $stat->icon,
                //     ];
                //     break;
                // case ('tpi_upto_50'):
                //     $this->stats[] = [
                //         'title' => $stat->name,
                //         'value' => (int) $stat->value ?? 0,
                //         'link' => route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'upto_50']),
                //         'icon' => $stat->icon,
                //     ];
                //     break;
                // case ('tpi_upto_80'):
                //     $this->stats[] = [
                //         'title' => $stat->name,
                //         'value' => (int) $stat->value ?? 0,
                //         'link' => route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'upto_80']),
                //         'icon' => $stat->icon,
                //     ];
                //     break;
                // case ('upto_90'):
                //     $this->stats[] = [
                //         'title' => $stat->name,
                //         'value' => (int) $stat->value ?? 0,
                //         'link' => route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'upto_90']),
                //         'icon' => $stat->icon,
                //     ];
                //     break;
                // case ('tpi_above_90'):
                //     $this->stats[] = [
                //         'title' => $stat->name,
                //         'value' => (int) $stat->value ?? 0,
                //         'link' => route('schemes', ['division' => $this->divisionId, 'tpiProgress' => 'above_90']),
                //         'icon' => $stat->icon,
                //     ];
                //     break;
                case ('imis_id_issue'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'imisIssue' => 'yes', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('without_subdivision'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['division' => $this->divisionId, 'without_subdivision' => 'yes', 'showType' => 'parent']),
                        'icon' => $stat->icon,
                    ];
                    break;
                default:
            }
        }

        if($statsData->isNotEmpty()){
            $this->stats[] = [
                    'title' => "Total Yesterday's BFM Readings",
                    'value' => DivisionBfmStats::whereDate('stats_date', Carbon::yesterday()->toDateString())
                                    ->where('division_id', $this->divisionId)->pluck('flowmeter_schemes')->first(),
                    'link' => '#',
                    'icon' => '/img/icons/bfm.png',
            ];
        }
    }

    public function render()
    {
        return view('livewire.division-dashboard.cards');
    }
}
