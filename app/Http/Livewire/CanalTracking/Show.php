<?php

namespace App\Http\Livewire\CanalTracking;

use App\Models\CanalTracking;
use App\Models\CanalTrackingPoint;
use App\Models\Scheme;
use Livewire\Component;

class Show extends Component
{
    public $schemeId;
    public $schemeName;
    public $schemeImis;
    public $schemeLocation;
    public $showDeleteButton = false;
    public $showDeletePointButton = false;

    public function mount(Scheme $scheme)
    {
        $this->schemeId = $scheme->id;
        $this->schemeName = $scheme->name;
        $this->schemeImis = $scheme->imis_id;
        $this->schemeLocation = [$scheme->latitude, $scheme->longitude];
    }

    public function getCanalTrackingPointsProperty()
    {
        $canalTrackingPoints = CanalTrackingPoint::where('scheme_id', $this->schemeId)->get();

        $points = $canalTrackingPoints->transform(fn($data) => [
            'type' => 'Feature',
            'properties' => [
                'id' => $data->id,
                'type' => $data->type,
                'category' => $data->category,
                'casing_type' => $data->casing_type,
                'size' => $data->size,
                'valve_manufacturer' => $data->valve_manufacturer,
                'image' => $data->image_url,
            ],
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    $data->longitude,
                    $data->latitude,
                ],
            ],
        ])->all();

        return [
            'type' => 'FeatureCollection',
            'features' => $points ?? [],
        ];
    }

    public function render()
    {
        $user = auth()->user();
        if ($user->isAdministrator() || $user->isSdo() || $user->isSectionOfficer() || $user->isGeologyHo() || $user->isExecutiveEngineer()) {
            $this->showDeleteButton = true;
            $this->showDeletePointButton = true;
        }

        $tracks = CanalTracking::query()
            ->whereNotNull('geojson')
            ->where('scheme_id', $this->schemeId)
        // ->limit(1)
            ->get()->transform(fn($data) => [
            'type' => 'Feature',
            'properties' => [
                'id' => $data->id,
                'reference_no' => $data->reference_no,
                'size' => $data->size,
                'distance' => $data->distance,
                'type' => $data->type,
                'quality' => $data->quality,
                'color' => $data->color_code,
                'scheme' => $this->schemeName,
                'imis_id' => $this->schemeImis,
                // 'color' => '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT),
            ],
            'geometry' => [
                'type' => 'LineString',
                'coordinates' => collect($data->geojson)->map(fn($geojson) => [
                    $geojson[1],
                    $geojson[0],
                ])->all(),
                // 'coordinates' => $data->geojson
            ],
        ]);

        if ($tracks->isNotEmpty()) {
            $locations = [
                'type' => 'FeatureCollection',
                'features' => $tracks,
            ];
        }
        return view('livewire.canal-tracking.show', [
            'locations' => $locations ?? null,
            'colorIndicators' => CanalTracking::whereNotNull('geojson')->where('scheme_id', $this->schemeId)->toBase()->distinct('size')->get(['color_code', 'size']),
        ]);
    }
}
