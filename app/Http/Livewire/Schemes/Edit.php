<?php

namespace App\Http\Livewire\Schemes;

use App\Enums\SchemeNature;
use App\Enums\SchemeOperatingStatus;
use App\Enums\SchemeTypes;
use App\Enums\SchemeWaterSource;
use App\Enums\SchemeWorkStatus;
use App\Models\FinancialYear;
use App\Models\Scheme;
use App\Models\WaterReport;
use Livewire\Component;

class Edit extends Component
{
    public $schemeId;
    public $latitude;
    public $longitude;
    public $name;
    public $scheme_uin;
    public $scheme_type;
    public $scheme_status;
    public $financial_year;
    // public $habitation;
    // public $work_status;
    public $operating_status;
    public $default_operating_status;
    public $approved_on;
    public $imis_id;
    public $has_tea_garden;
    public $planned_fhtc;
    public $achieved_fhtc;
    public $water_source;
    public $old_scheme_id;
    public $scheme_nature;
    public $total_cost;
    public $central_share;
    public $state_share;
    public $slssc_year;
    public $energy_type;
    public $reasons_disruption;
    public $specific_reasons;
    public $days_to_resolve;
    public $funding_agency;
    public $isPendingWaterDisruption;
    public $isHandedOver;
    public $showOperatingStatus;

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function mount(Scheme $scheme)
    {
        $this->schemeId = $scheme->id;

        $this->latitude = $scheme->latitude;
        $this->longitude = $scheme->longitude;
        $this->name = $scheme->name;
        $this->scheme_uin = $scheme->scheme_uin;
        $this->scheme_type = $scheme->scheme_type;
        $this->scheme_status = $scheme->scheme_status;
        $this->financial_year = $scheme->financial_year_id;
        // $this->habitation = $scheme->habitation;
        // $this->work_status = $scheme->work_status;
        $this->operating_status = $scheme->operating_status?->value;
        $this->default_operating_status = $scheme->operating_status?->value;

        $this->approved_on = $scheme->approved_on;
        $this->imis_id = $scheme->imis_id;
        $this->has_tea_garden = $scheme->has_tea_garden;
        $this->planned_fhtc = $scheme->planned_fhtc;
        $this->achieved_fhtc = $scheme->achieved_fhtc;
        $this->water_source = $scheme->water_source;
        $this->old_scheme_id = $scheme->old_scheme_id;
        $this->scheme_nature = $scheme->scheme_nature;
        $this->total_cost = $scheme->total_cost;
        $this->central_share = $scheme->central_share;
        $this->state_share = $scheme->state_share;
        $this->slssc_year = $scheme->slssc_year;
        $this->energy_type = $scheme->energy_type;
        $this->funding_agency = $scheme->funding_agency;
        $this->isHandedOver = $this->scheme->work_status?->value == 'handed-over';
        if (auth()->user()->isSectionOfficer()) {
            $waterDisruption = WaterReport::where('scheme_id', $this->schemeId)->where('closed_by', null)->exists();
            $this->isPendingWaterDisruption = $waterDisruption;
        }
       $this->showOperatingStatus = (auth()->user()->isSectionOfficer() && $this->isHandedOver) || ((auth()->user()->isAdministratorOrSuper() || auth()->user()->isExecutiveEngineer()) && !$this->isHandedOver);
    }

    public function save()
    {
        if (auth()->user()->isSectionOfficer()) {
            $validated = $this->validate([
                'name' => ['required'],
                'financial_year' => ['required'],
                'operating_status' => ['nullable'],
                'achieved_fhtc' => ['nullable', 'numeric'],
                'imis_id' => ['nullable', 'numeric'],
                'water_source' => ['nullable'],
                'approved_on' => ['nullable'],
                'old_scheme_id' => ['required', 'numeric'],
                'scheme_nature' => ['required'],
                'slssc_year' => ['nullable'],
                'energy_type' => ['nullable'],
                'funding_agency' => ['required'],
                'reasons_disruption' => [
                    $this->showFlowOption
                        ? 'required_if:operating_status,' . implode(',', $this->schemeOperatingStatusesForWater->pluck('value')->toArray())
                        : 'nullable',
                ],
                'specific_reasons' => [
                    $this->showFlowOption ? 'required_with:reasons_disruption' : 'nullable',
                ],
                'days_to_resolve' => [
                    $this->showFlowOption ? 'required_with:reasons_disruption' : 'nullable',
                    $this->showFlowOption ? 'integer' : null,
                ],
            ], [], [
                'old_scheme_id' => "SMT_ID",
            ]);
            $totalCost = $this->scheme->total_cost;
            $centralShare = $this->scheme->central_share;
            $stateShare = $this->scheme->state_share;
            if ($this->isHandedOver) {
                self::addNoWaterReport();
            }
        } else {
            $validated = $this->validate([
                'name' => ['required'],
                // 'scheme_type' => ['required'],
                'financial_year' => ['required'],
                // 'scheme_uin' => ['nullable'],
                //  'work_status' => ['required'],
                'operating_status' => ['nullable'],
                // 'planned_fhtc' => ['nullable', 'numeric'],
                'achieved_fhtc' => ['nullable', 'numeric'],
                // 'approved_on' => ['nullable'],
                'imis_id' => ['nullable'],
                'approved_on' => ['nullable'],
                'water_source' => ['nullable'],
                'old_scheme_id' => ['required'],
                'scheme_nature' => ['required'],
                // 'habitation' => ['nullable'],
                'total_cost' => ['required'],
                'central_share' => ['required'],
                'state_share' => ['required'],
                'slssc_year' => ['nullable'],
                'energy_type' => ['nullable'],
                'funding_agency' => ['required'],
            ], [], [
                'old_scheme_id' => "SMT_ID",
            ]);
            $totalCost = str_replace(',', '', $validated['total_cost']);
            $centralShare = str_replace(',', '', $validated['central_share']);
            $stateShare = str_replace(',', '', $validated['state_share']);
        }

        $operatingStatus = $validated['operating_status'];

        if ($validated['operating_status'] == '') {
            $operatingStatus = null;
        }

        $this->scheme->update([
            'name' => $validated['name'],
            // 'scheme_type' => $validated['scheme_type'],
            'financial_year_id' => $validated['financial_year'],
            // 'scheme_uin' => $validated['scheme_uin'],
            //  'work_status' => $validated['work_status'],
            'operating_status' => $operatingStatus ?? null,
            // 'planned_fhtc' => $validated['planned_fhtc'] ?? null,
            'achieved_fhtc' => $validated['achieved_fhtc'],
            'approved_on' => $validated['approved_on'],
            'imis_id' => $validated['imis_id'],
            'water_source' => $validated['water_source'],
            'old_scheme_id' => $validated['old_scheme_id'],
            'scheme_nature' => $validated['scheme_nature'],
            // 'habitation' => $validated['habitation']
            'total_cost' => $totalCost,
            'central_share' => $centralShare,
            'state_share' => $stateShare,
            'slssc_year' => $validated['slssc_year'],
            'energy_type' => $validated['energy_type'],
            'funding_agency' => $validated['funding_agency'],
        ]);
        if (auth()->user()->isSectionOfficer() && $this->isHandedOver && $this->operating_status != 'operative') {
            $this->scheme->update([
                'operating_status' => $this->default_operating_status,
            ]);
        }
        $this->notify('Scheme details updated.');
        $this->emit('refreshData');
        return redirect()->route('schemes.show', [$this->schemeId, 'tab' => 'details']);
    }

    public function getSchemeTypesProperty()
    {
        return SchemeTypes::cases();
    }

    public function getSchemeWorkStatusesProperty()
    {
        return SchemeWorkStatus::cases();
    }

    public function getSchemeOperatingStatusesProperty()
    {
        return collect(SchemeOperatingStatus::cases());
    }

    public function getSchemeOperatingStatusesForWaterProperty()
    {
        return collect(SchemeOperatingStatus::cases())->filter(function ($status) {
            return $status->value !== 'operative';
        });
    }


    public function getSchemeProperty()
    {
        return Scheme::findOrFail($this->schemeId);
    }

    public function getFinancialYearsProperty()
    {
        return FinancialYear::all();
    }

    public function getSchemeWaterSourceProperty()
    {
        return SchemeWaterSource::cases();
    }

    public function getSchemeNatureProperty()
    {
        return SchemeNature::cases();
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


    public function getShowFlowOptionProperty()
    {
        return auth()->user()->isSectionOfficer() && in_array($this->operating_status?->value ?? $this->operating_status, $this->schemeOperatingStatusesForWater->pluck('value')->toArray());
    }

    public function addNoWaterReport()
    {
        if ($this->showFlowOption) {
            return WaterReport::create([
                'scheme_id' => $this->schemeId,
                'user_id' => auth()->id(),
                'approved_by' => null,
                'status' => 'pending',
                'operating_status' => $this->operating_status,
                'operating_status_from' => $this->default_operating_status,
                'reasons_disruption' => $this->reasons_disruption,
                'specific_reasons' => $this->specific_reasons,
                'days' => $this->days_to_resolve,
                'remarks' => '',
                'resolved' => false,
            ]);
        }
        return null;
    }


    public function updated($selected)
    {
        if (in_array($selected, ['operating_status'])) {
            $this->reasons_disruption = null;
            $this->specific_reasons = null;
            $this->days_to_resolve = null;
        }
    }

    public function render()
    {
        return view('livewire.schemes.edit', [
            'approvedOnOptions' => [
                '1st SLSSC' => "1st SLSSC",
                '2nd SLSSC' => "2nd SLSSC",
                '3rd SLSSC' => "3rd SLSSC",
                '4th SLSSC' => "4th SLSSC",
            ],
            'energyType' => [
                'Electric',
                'Gravity',
                'Solar',
            ],
            'agencies' => config('freshman.funding_agencies'),
        ]);
    }
}
