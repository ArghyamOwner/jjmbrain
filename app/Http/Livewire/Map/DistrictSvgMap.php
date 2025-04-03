<?php

namespace App\Http\Livewire\Map;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class DistrictSvgMap extends Component
{
    public $datasets = [];

    public function mount()
    {
        $this->datasets = DB::table('beneficiaries')
            ->join('schemes', 'schemes.id', '=', 'beneficiaries.scheme_id')
            ->join('districts', 'districts.id', '=', 'schemes.district_id')
            ->groupBy('districts.name')
            ->selectRaw('districts.name as name, count(*) as value')
            ->orderBy('name')
            ->get();
    }

    public function render()
    {
        return view('livewire.map.district-svg-map');
    }
}
