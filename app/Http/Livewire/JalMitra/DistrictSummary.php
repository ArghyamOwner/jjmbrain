<?php

namespace App\Http\Livewire\JalMitra;

use App\Models\District;
use Livewire\Component;

class DistrictSummary extends Component
{
    public function render()
    {
        $data = District::query()
                ->withCount(['schemes', 'handoverSchemes', 'jalMitras'])
                ->orderBy('name')
                ->lazy()
                ->map(fn($item) => [
                    'id' => $item->id,
                    'District' => $item->name,
                    'Schemes' => $item->schemes_count,
                    'handoverSchemes' => $item->handover_schemes_count,
                    'jalmitras' => $item->jal_mitras_count,
                    'coverage (in %)' => round(($item->jal_mitras_count / $item->schemes_count) * 100, 2),
                ])
        ->toArray();

        return view('livewire.jal-mitra.district-summary', [
            'summary' => $data,
        ]);
    }
}
