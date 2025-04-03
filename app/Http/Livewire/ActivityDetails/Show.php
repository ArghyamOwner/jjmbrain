<?php

namespace App\Http\Livewire\ActivityDetails;

use App\Models\ActivityDetail;
use Livewire\Component;

class Show extends Component
{
    public $detail;

    public $venueStatus = false;
    public $topicsStatus = false;
    public $locations_visitedStatus = false;
    public $categoryStatus = false;
    public $praStatus = false;
    public $summaryStatus = false;
    public $key_pointsStatus = false;
    public $is_registeredStatus = false;
    public $is_acc_openedStatus = false;
    public $is_gp_approvedStatus = false;
    public $minutesStatus = false;
    public $resolutionStatus = false;
    public $attendanceStatus = false;
    public $photo1Status = false;
    public $photo2Status = false;
    public $committee_photoStatus = false;
    public $membersStatus = false;
    public $messageStatus = false;
    public $vapStatus = false;
    public $letterStatus = false;
    public $showDistrictApproval = false;

    public function mount(ActivityDetail $detail)
    {
        $this->detail = $detail->loadMissing('activity', 'district', 'block', 'panchayat', 'village', 'districtUser:id,name');

        if((! $this->detail->district_user_id) && auth()->user()->isIsaCoordinator())
        {
            $this->showDistrictApproval = true;
        }

        switch ($this->detail->activity->slug) {
            case ('gram'):
                $this->venueStatus = $this->minutesStatus = $this->resolutionStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('cluster'):
                $this->venueStatus = $this->topicsStatus = $this->minutesStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('community'):
                $this->venueStatus = $this->topicsStatus = $this->minutesStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('vwsc'):
                $this->venueStatus = $this->topicsStatus = $this->committee_photoStatus = $this->minutesStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('wcm'):
                $this->venueStatus = $this->topicsStatus = $this->minutesStatus = $this->membersStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('user'):
                $this->venueStatus = $this->topicsStatus = $this->minutesStatus = $this->membersStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('miking'):
                $this->locations_visitedStatus = $this->topicsStatus = $this->messageStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('pra'):
                $this->venueStatus = $this->categoryStatus = $this->praStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = $this->summaryStatus = true;
                break;

            case ('vap'):
                $this->venueStatus = $this->topicsStatus = $this->minutesStatus = $this->vapStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('fgd'):
                $this->venueStatus = $this->topicsStatus = $this->key_pointsStatus = $this->minutesStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('letter'):
                $this->letterStatus = true;
                break;

            case ('vwsc_status'):
                $this->is_registeredStatus = $this->is_acc_openedStatus = $this->is_gp_approvedStatus = true;
                break;

            default:
        }
    }

    public function render()
    {
        return view('livewire.activity-details.show');
    }
}
