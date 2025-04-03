<?php

namespace App\Http\Livewire\Schemes;

use Livewire\Component;
use Illuminate\Support\Facades\File;

class Map extends Component
{
    public function render()
    {
        $area = File::json(public_path('geojson/Area_Features.json'));
        $line = File::json(public_path('geojson/Line_Features.json'));
        $point = File::json(public_path('geojson/Point_Features.json'));

        return view('livewire.schemes.map', [
            'area' => $area,
            'line' => $line,
            'point' => $point,
        ])->layout('layouts.guest');
    }
}
