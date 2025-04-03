<?php

namespace App\Http\Livewire\Lithologs;

use App\Models\Litholog;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Map extends Component
{
    public function render()
    {
        $lithologs = Litholog::query()
            ->whereNotNull(['latitude', 'longitude'])
        // ->select('id', 'name', 'imis_id', 'latitude', 'longitude')
            ->cursor();

        $geoJSONdata = $lithologs->map(function ($data) {
            return [
                'type' => 'Feature',
                'properties' => [
                    'well_id' => $data->well_id,
                    'verified_by' => $data->verified_by,
                    'created_at' => $data->created_at?->format('d-m-Y'),
                    'type' => $data->drilling_type,
                    'link' => route('lithologs.show', $data->id)
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $data->longitude,
                        $data->latitude,
                    ],
                ],
            ];
        });
        $locations = [
            'type' => 'FeatureCollection',
            'features' => $geoJSONdata,
        ];
        return view('livewire.lithologs.map', [
            'locations' => $locations,
        ]);
    }
}
