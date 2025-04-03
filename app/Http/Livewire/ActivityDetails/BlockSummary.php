<?php

namespace App\Http\Livewire\ActivityDetails;

use App\Models\Activity;
use App\Models\Block;
use App\Models\District;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class BlockSummary extends Component
{
    public $district;

    public function mount($district)
    {
        $this->district = $district;
    }

// Fetch all blocks with counts of related Villages
    protected function fetchBlocks()
    {
        return Block::withCount(['villages'])->where('district_id', $this->district->id)->orderBy('name')->get();
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
            ->join('blocks', 'activity_details.block_id', '=', 'blocks.id')
            ->select('activities.id',
                'activities.name',
                'districts.id as district',
                'blocks.id as block',
                DB::raw('COUNT(activity_details.id) as total_activity_details'))
            ->where('activity_details.district_id', $this->district->id)
            ->groupBy('activities.id', 'activities.name', 'districts.id', 'blocks.id')
            ->get();
    }

    public function render()
    {
        $details = $this->fetchActivityDetails();
        $activitiesKey = $this->fetchActivitiesKey();
        $blocks = $this->fetchBlocks();

// Organize details into a more efficient structure
        $detailsByBlock = $details->groupBy('block');
        $final = [];
        foreach ($blocks as $block) {
            $blockDetails = $detailsByBlock->get($block->id, []);
            $activityCounts = [];
            foreach ($activitiesKey as $key) {
                $activityCount = 0;
                foreach ($blockDetails as $detail) {
                    if ($detail->name === $key) {
                        $activityCount = $detail->total_activity_details;
                        break;
                    }
                }
                $activityCounts[$key] = $activityCount;
            }
            $final[] = [
                'Block' => $block->name,
                'Village' => $block->villages_count,
                ...$activityCounts,
            ];
        }

        return view('livewire.activity-details.block-summary', [
            'summary' => $final,
        ]);
    }
}
