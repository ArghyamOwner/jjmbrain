<?php

namespace App\Http\Livewire\JalMitra;

use App\Models\District;
use App\Models\Division;
use Livewire\Component;

class Charts extends Component
{
    public function render()
    {
        $districts = District::query()
            ->withCount('jalMitras')
            ->orderBy('name')
            ->lazy()
            ->map(fn($item) => [
                'name' => $item->name,
                'count' => $item->jal_mitras_count,
            ]);

        $divisions = Division::query()
            ->withCount('jalMitras')
            ->orderBy('name')
            ->lazy()
            ->map(fn($item) => [
                'name' => $item->name,
                'count' => $item->jal_mitras_count,
            ]);
            
        return view('livewire.jal-mitra.charts', [
            'districtJm' => $districts,
            'divisionJm' => $divisions
        ]);
    }
}
