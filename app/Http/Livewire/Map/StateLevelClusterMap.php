<?php

namespace App\Http\Livewire\Map;

use App\Models\Lac;
use App\Models\Scheme;
use Livewire\Component;
use App\Models\District;
use App\Models\Division;
use Illuminate\Support\Facades\Storage;

class StateLevelClusterMap extends Component
{
    public $locations = [];
    public $assamDistrictBoundary;
    
    public function mount()
    {
        $this->assamDistrictBoundary = Storage::disk('pipeline')->url("assam_dist.json");
        
        $locationsQuery = Scheme::query()
            ->with(['division', 'blocks', 'district', 'lac'])
            ->whereNotNull(['latitude', 'longitude']);
            // ->whereIn('work_status', $this->statuses);

        $this->locations = [
            'type' => 'FeatureCollection',
            'features' => $locationsQuery
            // ->select(
            //     'id',
            //     'old_scheme_id',
            //     'imis_id',
            //     'latitude',
            //     'longitude',
            //     'name',
            //     'scheme_type',
            //     'work_status',
            //     'district_id',
            //     'lac_id',
            //     'block_id',
            //     'division_id',
            // )
            ->lazy()
            ->map(fn($data) => [
                'type' => 'Feature',
                'properties' => [
                    'scheme_name' => $data->name,
                    'scheme_type' => $data->scheme_type,
                    'scheme_working_status' => $data->work_status ?? 'no-status',
                    'scheme_category' => $data->scheme_category,
                    'links' => route('schemes.show', $data->id),
                    'district_id' => $data->district_id,
                    'district_name' => $data->district?->name,
                    'lac_id' => $data->lac_id,
                    'lac_name' => $data->lac?->name,
                    'block_id' => $data->block_id,
                    'block_name' => $data->block_names,
                    'division_id' => $data->division_id,
                    'division_name' => $data->division?->name,
                    'imis_id' => $data->imis_id,
                    'smt_id' => $data->old_scheme_id,
                ],
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [
                        $data->longitude,
                        $data->latitude,
                    ],
                ],
            ]),
        ];
    }

    public function getDistrictsProperty()
    {
        return District::orderBy('name')->pluck('name', 'id')->all();
    }

    public function getLacsProperty()
    {
        return Lac::orderBy('name')->pluck('name', 'id')->all();
    }

    public function getDivisionsProperty()
    {
        return Division::orderBy('name')->pluck('name', 'id')->all();
    }

    public function getStatusesProperty()
    {
        return ['handed-over', 'ongoing', 'no-status', 'not-started', 'completed'];
    }
 
    public function render()
    {
        return view('livewire.map.state-level-cluster-map', [
            'lacs' => $this->lacs,
            'districts' => $this->districts
        ]);
    }
}
