<?php

namespace App\Http\Livewire\ActivityDetails;

use App\Models\Activity;
use App\Models\District;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class DistrictSummary extends Component
{

// Fetch all districts with counts of related ISAs and villages
    protected function fetchDistricts()
    {
        return District::withCount(['isas', 'villages'])
            ->orderBy('name')
            ->get();
    }

// Fetch all activity names
    protected function fetchActivitiesKey()
    {
        return Activity::where('type', 'activity')->pluck('name')->all();
    }

// Fetch Activity Details
    protected function fetchActivityDetails()
    {
        return DB::table('activity_details')
            ->join('activities', 'activity_details.activity_id', '=', 'activities.id')
            ->join('districts', 'activity_details.district_id', '=', 'districts.id')
            ->select('activities.id', 'activities.name', 'districts.id as district', DB::raw('COUNT(activity_details.id) as total_activity_details'))
            ->groupBy('activities.id', 'activities.name', 'districts.id')
            ->get();
    }

    public function render()
    {
        $details = $this->fetchActivityDetails();
        $activitiesKey = $this->fetchActivitiesKey();
        $districts = $this->fetchDistricts();

// Organize details into a more efficient structure
        $detailsByDistrict = collect($details)->groupBy('district');

        $final = [];

        foreach ($districts as $district) {
            $districtDetails = $detailsByDistrict->get($district->id, []);

            $activityCounts = [];
            foreach ($activitiesKey as $key) {
                $activityCount = 0;
                foreach ($districtDetails as $detail) {
                    if ($detail->name === $key) {
                        $activityCount = $detail->total_activity_details;
                        break;
                    }
                }
                $activityCounts[$key] = $activityCount;
            }

            $final[] = [
                'id' => $district->id,
                'District' => $district->name,
                'ISA' => $district->isas_count,
                'Village' => $district->villages_count,
                ...$activityCounts,
            ];
        }

        return view('livewire.activity-details.district-summary',[
            'summary' => $final
        ]);
    }
}