<?php

namespace App\Http\Livewire\Lithologs;

use App\Models\Litholog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class HeatMap extends Component
{
    public function render()
    {
        $lithologsHeatMapData = Litholog::query()
            ->join('water_levels', 'lithologs.id', '=', 'water_levels.litholog_id')
            ->join('patterns', 'water_levels.pattern_id', '=', 'patterns.id')
            ->where('patterns.category', 'Aquifer')
            ->where('patterns.type', 'water_level')
            ->whereNotNull(['latitude', 'longitude'])
            ->select('lithologs.*', DB::raw('MIN(water_levels.start) as min_start'))
            ->groupBy('lithologs.id')
            ->get()
            ->transform(fn($data) => [
                'lat' => $data->latitude,
                'lng' => $data->longitude,
                'count' => $data->min_start,
            ])->all();

        return view('livewire.lithologs.heat-map',[
            'lithologs' => $lithologsHeatMapData,
            'mapBoundaryPolygon' => collect(config('assam-boundary.data'))->toArray(),
        ]);
    }
}
