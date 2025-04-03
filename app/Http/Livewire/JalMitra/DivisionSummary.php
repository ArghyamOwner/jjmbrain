<?php

namespace App\Http\Livewire\JalMitra;

use App\Models\Division;
use Livewire\Component;

class DivisionSummary extends Component
{
    public function render()
    {
        $data = Division::query()
        ->withCount(['schemes', 'handedoverSchemes', 'jalMitras'])
        ->orderBy('name')
        ->lazy()
        ->map(fn($item) => [
            'id' => $item->id,
            'Division' => $item->name,
            'Schemes' => $item->schemes_count,
            'handoverSchemes' => $item->handedover_schemes_count,
            'jalmitras' => $item->jal_mitras_count,
            'coverage (in %)' => $item->schemes_count ? round(($item->jal_mitras_count / $item->schemes_count) * 100, 2) : 0,
        ])
        ->toArray();

        return view('livewire.jal-mitra.division-summary',[
            'summary' => $data
        ]);
    }
}
