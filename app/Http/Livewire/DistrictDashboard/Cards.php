<?php

namespace App\Http\Livewire\DistrictDashboard;

use App\Enums\SchemeOperatingStatus;
use App\Enums\SchemeWorkStatus;
use App\Models\DistrictStat;
use Livewire\Component;

class Cards extends Component
{
    public $districtId;
    public $stats = [];

    public function mount($district)
    {
        $this->districtId = $district;
    }

    public function getStats()
    {
        $statsData = DistrictStat::query()
            ->whereDate('created_at', now())
            ->where('district_id', $this->districtId)
            ->get();

        foreach ($statsData as $stat) {
            switch ($stat->key) {
                case ('total_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId]),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('completed_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'status' => SchemeWorkStatus::COMPLETED]),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('ongoing_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'status' => SchemeWorkStatus::ONGOING]),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('handedover_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'status' => SchemeWorkStatus::HANDED_OVER]),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('operative_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'operating_status' => SchemeOperatingStatus::OPERATIVE]),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('partially_operative_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'operating_status' => SchemeOperatingStatus::PARTIALLY_OPERATIVE]),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('non_operative_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'operating_status' => SchemeOperatingStatus::NON_OPERATIVE]),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('apdcl_no_updated'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'hasConsumerNo' => true]),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('jalmitra_with_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('jm.users', ['district' => $this->districtId, 'hasScheme' => 'yes']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('jalmitra_without_scheme'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('jm.users', ['district' => $this->districtId, 'hasScheme' => 'no', 'status' => 'active']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('geotag_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'hasLocation' => 'with']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('lac_data_updated'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'hasLac' => true]),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('litholog_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'has_litholog' => 'yes']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('pending_lithologs'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('lithologs', ['district' => $this->districtId, 'type' => 'pending']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('schemes_with_wuc'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'hasWuc' => 'yes']),
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
                        'link' => route('schemes', ['district' => $this->districtId, 'qrInstalled' => 'yes']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('schemes_without_workorder'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'workorders' => 'no']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('schemes_workorder_value_below_10k'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'woValueBelow10k' => true]),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('fully_tracked_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'tracking' => 'yes']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('fhtc_mapped_schemes'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'fhtc' => 'yes']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('without_tpi_progress'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'tpiProgress' => 'no']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('tpi_upto_30'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'tpiProgress' => 'upto_30']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('tpi_upto_50'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'tpiProgress' => 'upto_50']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('tpi_upto_80'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'tpiProgress' => 'upto_80']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('upto_90'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'tpiProgress' => 'upto_90']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('tpi_above_90'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'tpiProgress' => 'above_90']),
                        'icon' => $stat->icon,
                    ];
                    break;
                case ('imis_id_issue'):
                    $this->stats[] = [
                        'title' => $stat->name,
                        'value' => (int) $stat->value ?? 0,
                        'link' => route('schemes', ['district' => $this->districtId, 'imisIssue' => 'yes']),
                        'icon' => $stat->icon,
                    ];
                    break;
                default:
            }
        }
    }

    public function render()
    {
        return view('livewire.district-dashboard.cards');
    }
}
