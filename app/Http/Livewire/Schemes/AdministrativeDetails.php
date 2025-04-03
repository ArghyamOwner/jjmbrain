<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Block;
use App\Models\District;
use App\Models\Division;
use App\Models\Habitation;
use App\Models\Lac;
use App\Models\Panchayat;
use App\Models\Scheme;
use App\Models\Subdivision;
use App\Models\Village;
use Livewire\Component;

class AdministrativeDetails extends Component
{
    public $schemeId;

    public $division;
    public $subdivision_id;
    public $district;
    public $block_id = [];
    public $lac_id;
    public $panchayat_ids = [];
    public $village_ids = [];
    public $habitation_ids = [];

    public function mount()
    {
        $scheme = $this->scheme;

        $this->division = $scheme->division_id;
        $this->subdivision_id = $scheme->latestSubdivision?->subdivision_id;
        $this->district = $scheme->district_id;
        $this->block_id = $scheme->blocks?->pluck('id')?->all();
        $this->panchayat_ids = $scheme->panchayats?->pluck('id')?->all();
        $this->village_ids = $scheme->villages?->pluck('id')?->all();
        $this->habitation_ids = $scheme->habitations?->pluck('id')?->all();
        $this->lac_id = $scheme->lac_id;
        // $this->panchayat = $scheme->panchayat;
        // $this->village = $scheme->village;
    }

    public function getSchemeProperty()
    {
        return Scheme::findOrFail($this->schemeId);
    }

    public function getDivisionsProperty()
    {
        return Division::orderBy('name')->pluck('name', 'id');
    }

    public function getDistrictsProperty()
    {
        return District::orderBy('name')->pluck('name', 'id');
    }

    public function getLacsProperty()
    {
        return Lac::orderBy('id')->get()
            ->map(fn($item) => [
                "label" => $item->name . " ($item->id)",
                "value" => $item->id,
            ])->all();
    }

    public function updatedDivision()
    {
        $this->reset(['subdivision_id']);
    }

    public function updatedDistrict()
    {
        $this->reset(['block_id', 'panchayat_ids', 'village_ids', 'habitation_ids']);
    }

    public function updatedBlockId()
    {
        $this->reset(['panchayat_ids', 'village_ids', 'habitation_ids']);
    }

    public function updatedPanchayatIds()
    {
        $this->reset(['village_ids', 'habitation_ids']);
    }

    public function updatedVillageIds()
    {
        $this->reset(['habitation_ids']);
    }

    public function save()
    {
        $validated = $this->validate([
            'division' => ['required'],
            'subdivision_id' => ['required'],
            'district' => ['required'],
            'block_id' => ['required'],
            'lac_id' => ['nullable'],
            'panchayat_ids' => ['required'],
            'village_ids' => ['required'],
            'habitation_ids' => ['required'],
        ],[],[
            'subdivision_id' => 'Subdivision'
        ]);

        $this->scheme->update([
            'division_id' => $validated['division'],
            'district_id' => $validated['district'],
            // 'block_id' => $validated['block_id'],
            'lac_id' => $validated['lac_id'],
            // 'panchayat' => $validated['panchayat'],
            // 'village' => $validated['village'],
        ]);

        $this->scheme->subdivisions()->sync($validated['subdivision_id']);
        $this->scheme->blocks()->sync($validated['block_id']);
        $this->scheme->panchayats()->sync($validated['panchayat_ids']);
        $this->scheme->villages()->sync($validated['village_ids']);
        $this->scheme->habitations()->sync($validated['habitation_ids']);

        $this->notify('Administrative details updated.');
    }

    public function render()
    {
        return view('livewire.schemes.administrative-details', [
            'blocks' => Block::where('district_id', $this->district)->get()->map(fn($item) => [
                'label' => $item->name,
                'value' => $item->id,
            ])->sortBy('label')->values()->all(),
            'panchayats' => Panchayat::whereIn('block_id', $this->block_id)->get()->map(fn($item) => [
                'label' => $item->panchayat_name,
                'value' => $item->id,
            ])->sortBy('label')->values()->all(),
            'villages' => Village::whereIn('panchayat_id', $this->panchayat_ids)->get()->map(fn($item) => [
                'label' => $item->village_name,
                'value' => $item->id,
            ])->sortBy('label')->values()->all(),
            'habitations' => Habitation::whereIn('village_id', $this->village_ids)->get()->map(fn($item) => [
                'label' => $item->habitation_name,
                'value' => $item->id,
            ])->sortBy('label')->values()->all(),
            'subdivisions' => Subdivision::where('division_id', $this->division)->orderBy('name')->pluck('name', 'id'),
        ]);
    }
}
