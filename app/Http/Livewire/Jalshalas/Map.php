<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\Jalshala;
use Livewire\Component;

class Map extends Component
{
    public $jalshalaId;

    public function mount($jalshala)
    {
        $this->jalshalaId = $jalshala;
    }

    public function render()
    {
        $jalshalaSchoolGeoJson = Jalshala::whereId($this->jalshalaId)
            ->with('jalshalaSchools.school')
            ->get()
            ->flatMap(function ($item) {
                return $item->jalshalaSchools->flatMap(function ($jalshalaSchool) {
                    // Wrap the single school instance in a collection
                    return collect([$jalshalaSchool->school])->map(function ($school) {
                        if ($school && $school->latitude !== null) {
                            return [
                                'type' => 'Feature',
                                'properties' => [
                                    'id' => $school->id,
                                    'school_name' => $school->school_name,
                                    'school_code' => $school->school_code,
                                ],
                                'geometry' => [
                                    'type' => 'Point',
                                    'coordinates' => [
                                        $school->longitude,
                                        $school->latitude,
                                    ],
                                ],
                            ];
                        }
                        return null;
                    });
                });
            });

        $jalshalaSchoolLocations = [
            'type'     => 'FeatureCollection',
            'features' => $jalshalaSchoolGeoJson,
        ];


        $jalshalaSchemeGeoJson = Jalshala::whereId($this->jalshalaId)->with('schemes')->get()->flatMap(function ($item) {
            return $item->schemes->filter(fn ($item) => $item->latitude != null)->map(function ($scheme) use ($item) {
                return [
                    'type' => 'Feature',
                    'properties' =>  [
                        'id' => $scheme->id,
                        'name' => $scheme->name,
                        'imis_id' => $scheme->imis_id,
                        'smt_id' => $scheme->old_scheme_id
                    ],
                    'geometry' => [
                        'type' => 'Point',
                        'coordinates' => [
                            $scheme->longitude,
                            $scheme->latitude,
                        ],
                    ],
                ];
            });
        });

        $jalshalaSchemeLocations = [
            'type'     => 'FeatureCollection',
            'features' => $jalshalaSchemeGeoJson,
        ];

        return view('livewire.jalshalas.map', [
            'jalshalaSchoolLocations' => $jalshalaSchoolLocations,
            'jalshalaSchemeLocations' => $jalshalaSchemeLocations
        ]);
    }
}
