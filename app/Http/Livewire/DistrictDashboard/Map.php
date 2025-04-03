<?php

namespace App\Http\Livewire\DistrictDashboard;

use App\Models\Scheme;
use Livewire\Component;

class Map extends Component
{
    public $districtId;

    public function mount($district)
    {
        $this->districtId = $district;
    }

    public function render()
    {
        $schemes = Scheme::query()
            ->whereNotNull(['latitude', 'longitude'])
            ->where('district_id', $this->districtId)
            ->select('id', 'name', 'imis_id', 'latitude', 'longitude')
            ->cursor();

        $geoJSONdata = $schemes->map(function ($data) {
            return [
                'type' => 'Feature',
                'properties' => [
                    'imis_id' => $data->imis_id,
                    'links' => $data->links['show'],
                    'name' => $data->name,
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
        
        return view('livewire.district-dashboard.map',[
            'locations' => $locations
        ]);
    }
}
