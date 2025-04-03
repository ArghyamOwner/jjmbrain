<?php

namespace App\Http\Livewire\CanalTracking;

use App\Models\CanalTracking;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PipeNetworkSummary extends Component
{
    public $schemeId;

    public function mount($schemeId)
    {
        $this->schemeId = $schemeId;
    }

    public function render()
    {
        $tracks = CanalTracking::query()
        ->select('size', 'color_code', DB::raw('SUM(distance) as total_distance'))
        ->where('scheme_id', $this->schemeId)
        ->groupBy('size', 'color_code')
        ->get();
        return view('livewire.canal-tracking.pipe-network-summary', [
            'summary' => $tracks,
            'total' => $tracks->sum('total_distance')    
        ]);
    }
}
