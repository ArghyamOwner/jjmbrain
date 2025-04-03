<?php

namespace App\Http\Livewire\Schemes;

use App\Enums\SchemeOperatingStatus;
use App\Enums\SchemeTypes;
use App\Enums\SchemeWaterSource;
use App\Enums\SchemeWorkStatus;
use App\Models\Block;
use App\Models\District;
use App\Models\Division;
use App\Models\FinancialYear;
use App\Models\Habitation;
use App\Models\Lac;
use App\Models\Panchayat;
use App\Models\Scheme;
use App\Models\Subdivision;
use App\Models\Village;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $name;
    public $scheme_uin;
    public $scheme_type;
    public $scheme_status;
    public $financial_year;
    public $work_status;
    public $operating_status;
    public $approved_on;
    public $imis_id;
    public $has_tea_garden;
    public $planned_fhtc;
    public $achieved_fhtc;
    public $water_source;

    public $division;
    public $subdivision_id;
    public $district;
    public $block;
    public $lac_id;
    public $panchayat = [];
    public $village = [];
    public $villageOptions = [];
    public $habitation = [];
    public $habitationOptions = [];

    public $old_scheme_id;
    public $total_cost;
    public $central_share;
    public $state_share;
    public $funding_agency;

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function save()
    {
        $validated = $this->validate([
            'financial_year' => ['required'],
            'name' => ['required'],
            'scheme_uin' => ['nullable', 'unique:schemes,scheme_uin'],
            'scheme_type' => ['required'],
            'work_status' => ['required'],
            'operating_status' => ['required'],
            'planned_fhtc' => ['nullable', 'numeric'],
            'achieved_fhtc' => ['nullable', 'numeric'],
            'approved_on' => ['nullable'],
            'imis_id' => ['nullable'],
            'old_scheme_id' => ['required', 'unique:schemes,old_scheme_id'],
            'water_source' => ['nullable'],

            'division' => ['required'],
            'subdivision_id' => ['required'],
            'district' => ['required'],
            'lac_id' => ['nullable'],
            'block' => ['required'],
            'panchayat' => ['required', 'array', 'min:1'],
            'village' => ['required', 'array', 'min:1', Rule::in(collect($this->villageOptions)->pluck('value')->all())],
            'habitation' => ['required', 'array', 'min:1', Rule::in(collect($this->habitationOptions)->pluck('value')->all())],
            'total_cost' => ['nullable'],
            'central_share' => ['nullable'],
            'state_share' => ['nullable'],
            'funding_agency' => ['required'],
        ], [], [
            'old_scheme_id' => "SMT_Id",
        ]);

        if ($validated['total_cost']) {
            $totalCost = str_replace(',', '', $validated['total_cost']);
        }
        if ($validated['central_share']) {
            $centralShare = str_replace(',', '', $validated['central_share']);
        }
        if ($validated['state_share']) {
            $stateShare = str_replace(',', '', $validated['state_share']);
        }
        
        $scheme = Scheme::create([
            'financial_year_id' => $validated['financial_year'],
            'name' => $validated['name'],
            'scheme_uin' => $validated['scheme_uin'],
            'scheme_type' => $validated['scheme_type'],
            'work_status' => $validated['work_status'],
            'operating_status' => $validated['operating_status'],
            'planned_fhtc' => $validated['planned_fhtc'],
            'achieved_fhtc' => $validated['achieved_fhtc'],
            'approved_on' => $validated['approved_on'],
            'imis_id' => $validated['imis_id'],
            'old_scheme_id' => $validated['old_scheme_id'],
            'water_source' => $validated['water_source'],
            // 'habitation' => $validated['habitation'],
            'division_id' => $validated['division'],
            'funding_agency' => $validated['funding_agency'],
            // 'block_id' => $validated['block'],
            'lac_id' => $validated['lac_id'],
            'lac_id' => $validated['lac_id'],
            // 'panchayat' => $validated['panchayat'],
            // 'village' => $validated['village'],
            'total_cost' => $totalCost ?? null,
            'central_share' => $centralShare ?? null,
            'state_share' => $stateShare ?? null,
            'district_id' => $validated['district'],
        ]);

        $scheme->subdivisions()->sync($validated['subdivision_id']);
        $scheme->blocks()->sync($validated['block']);
        $scheme->panchayats()->sync($validated['panchayat']);
        $scheme->villages()->sync($validated['village']);
        $scheme->habitations()->sync($validated['habitation']);

        $this->banner('Scheme details saved.');

        return redirect()->route('schemes');
    }

    public function getSchemeTypesProperty()
    {
        return SchemeTypes::cases();
    }

    public function getSchemeWorkStatusesProperty()
    {
        return SchemeWorkStatus::cases();
    }

    public function getSchemeWaterSourceProperty()
    {
        return SchemeWaterSource::cases();
    }

    public function getSchemeOperatingStatusesProperty()
    {
        return SchemeOperatingStatus::cases();
    }

    public function getFinancialYearsProperty()
    {
        return FinancialYear::all();
    }

    public function getDivisionsProperty()
    {
        return Division::orderBy('name')->pluck('name', 'id');
    }

    public function getLacsProperty()
    {
        return Lac::orderBy('id')->get()
            ->map(fn($item) => [
                "label" => $item->name . " ($item->id)",
                "value" => $item->id,
            ])->all();
    }

    public function getDistrictsProperty()
    {
        return District::orderBy('name')->pluck('name', 'id');
    }

    public function updatedDivision()
    {
        $this->reset(['subdivision_id']);
    }

    public function updatedPanchayat($values)
    {
        $this->villageOptions = Village::whereIn('panchayat_id', $values)
            ->get()
            ->map(fn($item) => [
                'label' => $item->village_name,
                'value' => $item->id,
            ])
            ->sortBy('label')
            ->values()
            ->all();
    }
    public function updatedVillage($values)
    {
        $this->habitationOptions = Habitation::whereIn('village_id', $values)
            ->get()
            ->map(fn($item) => [
                'label' => $item->habitation_name,
                'value' => $item->id,
            ])
            ->sortBy('label')
            ->values()
            ->all();
    }

    public function render()
    {
        if ($this->block) {
            $panchayat = Panchayat::where('block_id', $this->block)
                ->orderBy('panchayat_name')
                ->get()
                ->map(fn($item) => [
                    'label' => $item->panchayat_name,
                    'value' => $item->id,
                ])
                ->all();
        }

        return view('livewire.schemes.create', [
            'subdivisions' => Subdivision::where('division_id', $this->division)->pluck('name', 'id'),
            'blocks' => Block::where('district_id', $this->district)->pluck('name', 'id'),
            'panchayats' => $panchayat ?? [],
            'villageOptions' => $this->villageOptions ?? [],
            'habitationOptions' => $this->habitationOptions ?? [],
            'approvedOnOptions' => [
                '1st SLSSC' => "1st SLSSC",
                '2nd SLSSC' => "2nd SLSSC",
                '3rd SLSSC' => "3rd SLSSC",
                '4th SLSSC' => "4th SLSSC",
            ],
            'agenciesOptions' => config('freshman.funding_agencies'),
        ]);
    }
}
