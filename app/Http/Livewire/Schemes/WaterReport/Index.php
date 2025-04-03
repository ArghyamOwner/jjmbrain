<?php

namespace App\Http\Livewire\Schemes\WaterReport;

use App\Enums\WaterDisruptionStatus;
use App\Models\Division;
use App\Models\Scheme;
use App\Models\Subdivision;
use App\Models\WaterReport;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $reasons_disruption;
    public $specific_reasons;
    public $division;
    public $sub_division;
    public $sub_divisions = [];
    public $water_disruption_status;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function resetFilter()
    {
        $this->reset([
            'search',
        ]);
    }

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function getDivisionsProperty()
    {
        $user = auth()->user();
        return Division::query()
            ->when(($user->isExecutiveEngineer() || $user->isTpaAdmin() || $user->isSdo()),
                fn($query) => $query->whereIn('id', $user->divisions()->pluck('division_id'))
            )
            ->orderBy('name')
            ->pluck('name', 'id');
    }

    public function updatedDivision()
    {
        if ($this->division) {
            $this->sub_divisions = Subdivision::where('division_id', $this->division)->get()->pluck('name', 'id');
        } else {
            $this->sub_divisions = [];
        }
    }

    public function getIssueTypesProperty()
    {
        return Scheme::getIssueTypes();
    }

    public function getReasonsDisruptionProperty()
    {
        if ($this->reasons_disruption == Scheme::TECHNICAL_ISSUES_PWSS) {
            return array_map(function ($key, $value) {
                return ['value' => $key, 'label' => $value];
            }, array_keys(Scheme::getTechnicalIssuesPwss()), Scheme::getTechnicalIssuesPwss());
        } else if ($this->reasons_disruption == Scheme::ADMINISTRATIVE_ISSUES) {
            return array_map(function ($key, $value) {
                return ['value' => $key, 'label' => $value];
            }, array_keys(Scheme::getAdministrativeIssues()), Scheme::getAdministrativeIssues());
        } else if ($this->reasons_disruption == Scheme::TECHNICAL_ISSUES_APDCL) {
            return array_map(function ($key, $value) {
                return ['value' => $key, 'label' => $value];
            }, array_keys(Scheme::getInstitutionalIssues()), Scheme::getInstitutionalIssues());
        }
        return [];
    }

    public function getWaterDisruptionStatusesProperty()
    {
        return WaterDisruptionStatus::toArray();
    }


    public function filterData() {}

    public function getWaterReportsProperty()
    {
        $user = auth()->user();
        return WaterReport::query()
            ->has('scheme')
            ->with(['scheme.division', 'scheme.blocks'])
            ->when($this->search != '', function ($query) {
                $query->whereLike(['reasons_disruption', 'specific_reasons'], $this->search)
                    ->orWhereHas('scheme', function ($query) {
                        $query->whereLike(['name', 'imis_id'], $this->search);
                    });
            })
            ->when($user->isSectionOfficer(), fn($query) => $query->where('user_id', Auth::id()))
            ->when($this->division, fn($query) => $query->whereHas('scheme', function ($query) {
                $query->where('division_id', $this->division);
            }))
            ->when($this->sub_division, function ($query) {
                return $query->whereHas('scheme', function ($query) {
                    return $query->whereHas('subdivisions', function ($query) {
                        return $query->where('subdivision_id', $this->sub_division);
                    });
                });
            })
            ->when($this->water_disruption_status, fn($query) => $query->where('status', $this->water_disruption_status))
            ->when($this->reasons_disruption, fn($query) => $query->where('reasons_disruption', $this->reasons_disruption))
            ->when($this->specific_reasons, fn($query) => $query->whereJsonContains('specific_reasons', $this->specific_reasons))
            ->when(
                $user->isSdo() || $user->isExecutiveEngineer(),
                fn($query) =>
                $query->whereHas(
                    'scheme',
                    fn($query) =>
                    $query->whereIn('division_id', $user->divisions()->pluck('division_id'))
                )
            )
            // ->when(
            //     $user->isExecutiveEngineer(),
            //     fn($query) =>
            //     $query->whereHas(
            //         'scheme',
            //         fn($query) =>
            //         $query->whereIn('division_id', $user->divisions()->pluck('division_id'))
            //     )
            // )
            ->latest('id')
            ->fastPaginate(10);
    }

    public function render()
    {
        return view('livewire.schemes.water-report.index');
    }
}
