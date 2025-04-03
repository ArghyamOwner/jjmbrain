<?php

namespace App\Http\Livewire\DivisionDashboard;

use App\Models\Division;
use App\Models\Scheme;
use Livewire\Component;

class Map extends Component
{
    public $divisionId;

    public function mount($division)
    {
        $this->divisionId = $division;
    }

    public function getDistrictBoundaries()
    {
        $urls = [];
        $division = Division::with('districts')->findOrFail($this->divisionId);
        foreach ($division->districts as $district) {
            $urls[] = "https://sumatoimg.nyc3.digitaloceanspaces.com/jjm/district_boundary/$district->slug.json";
        }
        return $urls;
    }

    public function render()
    {
        $schemes = Scheme::query()
            ->whereNotNull(['latitude', 'longitude'])
            ->where('division_id', $this->divisionId)
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

        return view('livewire.division-dashboard.map', [
            'locations' => $locations,
            'geojsonUrl' => $this->getDistrictBoundaries()
        ]);
    }
}
