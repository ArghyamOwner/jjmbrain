<?php

namespace App\Http\Livewire\Wucs;

use App\Models\Block;
use App\Models\District;
use App\Models\Panchayat;
use App\Models\RevenueCircle;
use App\Models\Scheme;
use App\Models\SchemeActivity;
use App\Models\Village;
use App\Models\Wuc;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rule;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public $name;
    public $district_id;
    public $revenue_circle_id;
    public $block_id;
    public $formation_date;
    public $approval_date;
    public $approval_document;
    public $constitution_document;
    public $bank_name;
    public $account_number;
    public $ifsc;
    public $fhtc;
    public $household;
    public $difference = 0;
    public $tariff_per_hh;
    public $president_name;
    public $secretary_name;

    public $circles = [];
    public $blocks = [];
    public $panchayat = [];
    public $village = [];
    public $villageOptions = [];
    public $schemes = [];
    public $schemeOptions = [];

    public function save()
    {
        $validatedData = $this->validate([
            'name' => ['required', 'string', 'max:255'],
            'president_name' => ['required', 'string', 'max:255'],
            'secretary_name' => ['required', 'string', 'max:255'],
            'district_id' => ['required'],
            'revenue_circle_id' => ['required'],
            'block_id' => ['required'],
            'formation_date' => ['required'],
            'approval_date' => ['required'],
            'approval_document' => ['required', 'mimes:pdf'],
            'constitution_document' => ['nullable', 'mimes:pdf'],
            'bank_name' => ['nullable'],
            'account_number' => ['nullable'],
            'ifsc' => ['nullable'],
            'fhtc' => ['required'],
            'household' => ['required'],
            'tariff_per_hh' => ['required'],
            'panchayat' => ['required', 'array', 'min:1'],
            'village' => ['required', 'array', 'min:1', Rule::in(collect($this->villageOptions)->pluck('value')->all())],
            'schemes' => ['required', 'array', 'min:1', Rule::in(collect($this->schemeOptions)->pluck('value')->all())],
        ]);

        $wuc = Wuc::create($validatedData);

        $wuc->schemes()->sync($validatedData['schemes']);

        foreach ($validatedData['schemes'] as $scheme) {
            SchemeActivity::create([
                'user_id' => auth()->id(),
                'scheme_id' => $scheme,
                'activity_type' => 'wuc_assigned',
                'content' => 'WUC Assigned',
                'feedable_type' => get_class(new Scheme()),
                'feedable_id' => $scheme,
            ]);
        }

        if ($validatedData['approval_document']) {
            $wuc->update([
                'approval_document' => $validatedData['approval_document']->storePublicly('/', 'uploads'),
            ]);
        }
        if ($validatedData['constitution_document']) {
            $wuc->update([
                'constitution_document' => $validatedData['constitution_document']->storePublicly('/', 'uploads'),
            ]);
        }
        $this->banner('WUC Created Successfully');
        return redirect()->route('wucs');

    }

    public function getDistrictsProperty()
    {
        if (auth()->user()->isIsaCoordinator() || auth()->user()->isDc()) {
            return auth()->user()->districts?->pluck('name', 'id')->all();
        }
        return District::orderBy('name')->pluck('name', 'id')->all();
    }

    public function updatedDistrictId()
    {
        $this->reset('revenue_circle_id', 'block_id', 'panchayat', 'village', 'schemes');
        $this->circles = RevenueCircle::orderBy('name')->where('district_id', $this->district_id)->pluck('name', 'id')->all();
        $this->blocks = Block::orderBy('name')->where('district_id', $this->district_id)->pluck('name', 'id')->all();
    }

    public function updatedFhtc()
    {
        $this->difference = (int) $this->fhtc - (int) $this->household;
    }

    public function updatedHousehold()
    {
        $this->difference = (int) $this->fhtc - (int) $this->household;
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
        $user = auth()->user();
        $this->schemeOptions = Scheme::query()
            ->whereHas('villages', fn($q) => $q->whereIn('village_id', $values))
            ->when($user->isIsaCoordinator() || $user->isStateIsa(), function ($q) {
                $q->parent();
            })
            ->get()
            ->map(fn($item) => [
                'label' => $item->name . ' (SMT - ' . $item->old_scheme_id . ')',
                'value' => $item->id,
            ])
            ->sortBy('label')
            ->values()
            ->all();
    }

    public function render()
    {
        if ($this->block_id) {
            $panchayat = Panchayat::where('block_id', $this->block_id)
                ->orderBy('panchayat_name')
                ->get()
                ->map(fn($item) => [
                    'label' => $item->panchayat_name,
                    'value' => $item->id,
                ])
                ->all();
        }
        return view('livewire.wucs.create', [
            'panchayats' => $panchayat ?? [],
            'villageOptions' => $this->villageOptions ?? [],
            'schemeOptions' => $this->schemeOptions ?? [],
        ]);
    }
}
