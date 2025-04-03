<?php

namespace App\Http\Livewire\Grievances;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class TopSchemes extends Component
{
    public function render()
    {
        return view('livewire.grievances.top-schemes', [
            'schemes' => DB::table('schemes')
                ->join('grievances', 'schemes.id', '=', 'grievances.scheme_id')
                ->join('divisions', 'divisions.id', '=', 'schemes.division_id')
                ->select('schemes.id', 'schemes.name', 'divisions.name as div_name', DB::raw('COUNT(grievances.id) as grievance_count'))
                ->where('schemes.is_archived', '=', 0)
                ->groupBy('schemes.id', 'schemes.name', 'div_name')
                ->orderByDesc('grievance_count')
                ->take(10)
                ->get(),
        ]);
    }
}
