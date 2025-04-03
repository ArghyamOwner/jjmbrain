<?php

namespace App\Http\Livewire\ActivityDetails;

use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class DistrictApproval extends Component
{
    use InteractsWithBanner;
    public $activity;


    public function mount($activity)
    {
        $this->activity = $activity;
    }

    public function verify()
    {
        $this->activity->update([
            'district_user_id' => Auth::id(),
            'district_approved_date' => now(),
        ]);

        $this->banner('Activity Verified.');
        return redirect()->route('activityDetails.show', $this->activity->id);
    }
    public function render()
    {
        return view('livewire.activity-details.district-approval');
    }
}
