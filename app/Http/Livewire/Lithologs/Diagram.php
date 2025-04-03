<?php

namespace App\Http\Livewire\Lithologs;

use App\Models\CasingDiagram;
use App\Models\Lithology;
use App\Models\WaterLevel;
use Livewire\Component;

class Diagram extends Component
{
    public $litholog;

    public function render()
    {
        $lithologies = Lithology::query()
            ->with('pattern')
            ->where('litholog_id', $this->litholog)
            ->get()
            ->transform(fn($item) => [
                'from' => $item->start,
                'to' => $item->end,
                'code' => $item?->pattern?->number.'.svg',
                'code_name' => $item?->pattern?->category,
                'remarks' => $item->remarks,
            ]);

            // dd($lithologies);
        $caseDiagram = CasingDiagram::query()
            ->with('pattern')
            ->where('litholog_id', $this->litholog)
            ->get()
            ->transform(fn($item) => [
                'from' => $item->start,
                'to' => $item->end,
                'code' => $item?->pattern?->number.'.svg',
                'code_name' => $item?->pattern?->category,
                'remarks' => $item->remarks,
            ]);

        $waterLevel = WaterLevel::query()
            ->with('pattern')
            ->where('litholog_id', $this->litholog)
            ->get()
            ->transform(fn($item) => [
                'from' => $item->start,
                'to' => $item->end,
                'code' => $item?->pattern?->number.'.svg',
                'code_name' => $item?->pattern?->category,
                'remarks' => $item->remarks,
            ]);

        return view('livewire.lithologs.diagram', [
            'lithologies' => $lithologies,
            'caseDiagram' => $caseDiagram,
            'waterLevel' => $waterLevel,
        ]);
    }
}
