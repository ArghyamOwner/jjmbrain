<?php

namespace App\Http\Livewire\ActivityDetails;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Stats extends Component
{
    public $stats = [];

    public function getStats()
    {
        $activityDetails = DB::table('activity_details')
            ->join('activities', 'activity_details.activity_id', '=', 'activities.id')
            ->select('activities.id', 'activities.name', DB::raw('COUNT(activity_details.id) as total_activity_details'))
            ->groupBy('activities.id', 'activities.name')
            ->get();

        $this->stats['Total activities'] = DB::table('activity_details')->count();

        foreach ($activityDetails as $detail) {
            $this->stats[$detail->name] = $detail->total_activity_details;
        }
    }

    public function render()
    {
        return view('livewire.activity-details.stats');
    }
}
