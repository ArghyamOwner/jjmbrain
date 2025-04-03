<?php

namespace App\Http\Livewire\Map;

use App\Models\Beneficiary;
use App\Models\CanalTracking;
use App\Models\Scheme;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class SchemeNetworkMap extends Component
{
    public $schemeId;
    public $oldSchemeId;
    public $latitude;
    public $longitude;
    public $geojsonUrl;
    public $schemeName;

    public function mount(Scheme $scheme)
    {
        $this->schemeId = $scheme->id;
        $this->schemeName = $scheme->name;
        $this->oldSchemeId = $scheme->old_scheme_id;
        $this->latitude = $scheme->latitude ?? 26.2006;
        $this->longitude = $scheme->longitude ?? 92.9376;

        $this->geojsonUrl = Storage::disk('pipeline')->url("{$this->oldSchemeId}.json");
    }

    public function getBeneficiaries()
    {
        $beneficiaryCoordinates = Beneficiary::where('scheme_id', $this->schemeId)->get()->transform(fn($beneficiary) => [
            'type' => 'Feature',
            'properties' => [
                "beneficiary_name" => $beneficiary['beneficiary_name'],
                "address" => $beneficiary['address'],
                "phone" => $beneficiary['beneficiary_phone'],
            ],
            'geometry' => [
                'type' => 'Point',
                'coordinates' => [
                    (float) $beneficiary['longitude'],
                    (float) $beneficiary['latitude'],
                ],
            ],
        ]);

        return [
            'type' => "FeatureCollection",
            'features' => $beneficiaryCoordinates,
        ];
    }

    public function getCanalTracks()
    {
        $tracks = CanalTracking::query()
            ->whereNotNull('geojson')
            ->where('scheme_id', $this->schemeId)
        // ->limit(1)
            ->get()->transform(fn($data) => [
            'type' => 'Feature',
            'properties' => [
                'size' => $data->size,
                'type' => $data->type,
                'quality' => $data->quality,
                'color' => $data->color_code,
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
            return [
                'type' => 'FeatureCollection',
                'features' => $tracks,
            ];
        }
        return null;
    }

    public function getNetworkMapCoordinatesProperty()
    {
        if ($this->oldSchemeId) {
            // return File::json("geojson/{$this->oldSchemeId}.geojson");
            $response = Http::get(Storage::disk('pipeline')->url("{$this->oldSchemeId}.geojson"));

            if ($response->ok()) {
                return $response->body();
            }
        } else {
            return [];
        }
    }

    public function render()
    {
        return view('livewire.map.scheme-network-map', [
            'locations' => $this->getBeneficiaries(),
            'canalTracks' => $this->getCanalTracks(),
        ]);
    }
}
