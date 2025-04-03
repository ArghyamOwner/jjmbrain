<?php

namespace App\Http\Livewire\Isa;

use App\Models\Block;
use App\Models\District;
use App\Models\Isa;
use App\Models\Panchayat;
use App\Models\Village;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $name;
    public $type;
    public $contact_name;
    public $contact_phone;

    public $district;
    public $block;
    public $blocks = [];
    public $panchayat = [];
    public $panchayats = [];
    public $village = [];
    public $villageOptions = [];

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'type' => ['required'],
            'contact_name' => ['required'],
            'district' => ['required'],
            'block' => ['required'],
            'contact_phone' => ['required'],
            'village' => ['required', 'array', 'min:1', Rule::in(collect($this->villageOptions)->pluck('value')->all())],
        ]);

        $isa = Isa::create($validated + [
            'district_id' => $validated['district'],
            'block_id' => $validated['block'],
        ]);
        $isa->villages()->sync($validated['village']);

        $this->banner('New ISA added.');
        return redirect()->route('isa');
    }

    public function getDistrictsProperty()
    {
        if (auth()->user()->isIsaCoordinator() || auth()->user()->isDc()) {
            return auth()->user()->districts?->pluck('name', 'id')->all();
        }
        return District::orderBy('name')->pluck('name', 'id')->all();
    }

    public function updatedDistrict()
    {
        $this->reset('block', 'panchayat', 'village');
        $this->panchayats = [];
        $this->villageOptions = [];
        $this->blocks = Block::where('district_id', $this->district)->pluck('name', 'id')->all();
    }

    public function updatedBlock()
    {
        $this->reset('panchayat', 'village');
        $this->villageOptions = [];
        $this->panchayats = Panchayat::where('block_id', $this->block)
            ->orderBy('panchayat_name')
            ->get()
            ->map(fn($item) => [
                'label' => $item->panchayat_name,
                'value' => $item->id,
            ])
            ->all();
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

    public function render()
    {
        // if ($this->block) {

        // }

        return view('livewire.isa.create', [
            'blocks' => $this->blocks,
            'panchayats' => $this->panchayats ?? [],
            'villageOptions' => $this->villageOptions ?? [],
        ]);
    }
}
