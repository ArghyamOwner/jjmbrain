<?php

namespace App\Http\Livewire\ActivityDetails;

use App\Models\Activity;
use App\Models\ActivityDetail;
use App\Models\Block;
use App\Models\District;
use App\Models\Panchayat;
use App\Models\Village;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public $phase;
    public $activity_id;
    public $district_id;
    public $block_id;
    public $panchayat_id;
    public $village_id;
    public $scheme_id;
    public $venue;
    public $topics;
    public $date;
    public $locations_visited;
    public $category;
    public $pra;
    public $summary;
    public $key_points;
    public $is_registered;
    public $registration_no;
    public $is_acc_opened;
    public $account_no;
    public $is_gp_approved;
    public $minutes;
    public $resolution;
    public $attendance;
    public $photo1;
    public $photo2;
    public $committee_photo;
    public $members;
    public $message;
    public $vap;
    public $letter;
    public $bank_passbook;
    public $gp_approved_copy;

    public $blocks = [];
    public $gps = [];
    public $villages = [];

    public $phaseStatus = true;
    public $district_idStatus = true;
    public $block_idStatus = true;
    public $panchayat_idStatus = true;
    public $village_idStatus = true;
    public $scheme_idStatus = true;
    public $venueStatus = true;
    public $topicsStatus = true;
    public $dateStatus = true;
    public $locations_visitedStatus = true;
    public $categoryStatus = true;
    public $praStatus = true;
    public $summaryStatus = true;
    public $key_pointsStatus = true;
    public $is_registeredStatus = true;
    public $registration_noStatus = true;
    public $is_acc_openedStatus = true;
    public $account_noStatus = true;
    public $is_gp_approvedStatus = true;
    public $minutesStatus = true;
    public $resolutionStatus = true;
    public $attendanceStatus = true;
    public $photo1Status = true;
    public $photo2Status = true;
    public $committee_photoStatus = true;
    public $membersStatus = true;
    public $messageStatus = true;
    public $vapStatus = true;
    public $letterStatus = true;
    public $bank_passbookStatus = true;
    public $gp_approved_copyStatus = true;

    public function getActivitiesProperty()
    {
        return Activity::orderBy('name')->typeActivity()->pluck('name', 'id')->all();
    }

    public function getDistrictsProperty()
    {
        return District::orderBy('name')->pluck('name', 'id')->all();
    }

    public function updatedActivityId()
    {
        $activity = Activity::where('id', $this->activity_id)->typeActivity()->first();

        if (!$activity) {
            return $this->notify('Invalid Activity', 'error');
        }

        $this->reset(
            'phase',
            'district_id',
            'block_id',
            'panchayat_id',
            'village_id',
            'scheme_id',
            'venue',
            'topics',
            'date',
            'locations_visited',
            'category',
            'pra',
            'summary',
            'key_points',
            'is_registered',
            'registration_no',
            'is_acc_opened',
            'account_no',
            'is_gp_approved',
            'minutes',
            'resolution',
            'attendance',
            'photo1',
            'photo2',
            'committee_photo',
            'members',
            'message',
            'vap',
            'letter',
            'bank_passbook',
            'gp_approved_copy'
        );

        $this->phaseStatus = $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->venueStatus = $this->topicsStatus = $this->locations_visitedStatus = $this->categoryStatus = $this->praStatus = $this->summaryStatus = $this->key_pointsStatus = $this->is_registeredStatus = $this->registration_noStatus = $this->is_acc_openedStatus = $this->account_noStatus = $this->is_gp_approvedStatus = $this->minutesStatus = $this->resolutionStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = $this->committee_photoStatus = $this->membersStatus = $this->messageStatus = $this->vapStatus = $this->letterStatus = $this->bank_passbookStatus = $this->gp_approved_copyStatus = false;

        switch ($activity->slug) {
            case ('gram'):
                $this->phaseStatus = $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->venueStatus = $this->minutesStatus = $this->resolutionStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('cluster'):
                $this->phaseStatus = $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->venueStatus = $this->topicsStatus = $this->minutesStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('community'):
                $this->phaseStatus = $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->venueStatus = $this->topicsStatus = $this->minutesStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('vwsc'):
                $this->phaseStatus = $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->venueStatus = $this->topicsStatus = $this->committee_photoStatus = $this->minutesStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('wcm'):
                $this->phaseStatus = $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->venueStatus = $this->topicsStatus = $this->minutesStatus = $this->membersStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('user'):
                $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->venueStatus = $this->topicsStatus = $this->minutesStatus = $this->membersStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('miking'):
                $this->phaseStatus = $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->locations_visitedStatus = $this->topicsStatus = $this->messageStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('pra'):
                $this->phaseStatus = $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->venueStatus = $this->categoryStatus = $this->praStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = $this->summaryStatus = true;
                break;

            case ('vap'):
                $this->phaseStatus = $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->venueStatus = $this->topicsStatus = $this->minutesStatus = $this->vapStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('fgd'):
                $this->phaseStatus = $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->venueStatus = $this->topicsStatus = $this->key_pointsStatus = $this->minutesStatus = $this->attendanceStatus = $this->photo1Status = $this->photo2Status = true;
                break;

            case ('letter'):
                $this->phaseStatus = $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->letterStatus = true;
                break;

            case ('vwsc_status'):
                $this->district_idStatus = $this->block_idStatus = $this->panchayat_idStatus = $this->village_idStatus = $this->is_registeredStatus = $this->is_acc_openedStatus = $this->is_gp_approvedStatus = true;
                break;

            default:
        }
    }

    public function updatedDistrictId()
    {
        $this->reset('panchayat_id', 'village_id');
        $this->blocks = Block::where('district_id', $this->district_id)->orderBy('name')->pluck('name', 'id')->all();
    }

    public function updatedBlockId()
    {
        $this->reset('village_id');
        $this->gps = Panchayat::where('block_id', $this->block_id)->orderBy('panchayat_name')->pluck('panchayat_name', 'id')->all();
    }

    public function updatedPanchayatId()
    {
        $this->villages = Village::where('panchayat_id', $this->panchayat_id)->orderBy('village_name')->pluck('village_name', 'id')->all();
    }

    public function save()
    {
        $validatedData = $this->validate([
            'activity_id' => ['required'],
            'phase' => ['required'],
            'district_id' => ['required'],
            'block_id' => ['required'],
            'panchayat_id' => ['required'],
            'village_id' => ['required'],
            'venue' => ['nullable'],
            'topics' => ['nullable'],
            'date' => ['required'],
            'locations_visited' => ['nullable'],
            'category' => ['nullable'],
            'pra' => ['nullable', 'mimes:pdf'],
            'summary' => ['nullable'],
            'key_points' => ['nullable'],
            'is_registered' => ['nullable'],
            'registration_no' => ['nullable'],
            'is_acc_opened' => ['nullable'],
            'account_no' => ['nullable'],
            'is_gp_approved' => ['nullable'],
            'minutes' => ['nullable', 'mimes:pdf'],
            'resolution' => ['nullable', 'mimes:pdf'],
            'attendance' => ['nullable', 'image', 'max:2048'],
            'photo1' => ['nullable', 'image', 'max:2048'],
            'photo2' => ['nullable', 'image', 'max:2048'],
            'committee_photo' => ['nullable', 'image', 'max:2048'],
            'members' => ['nullable', 'image', 'max:2048'],
            'message' => ['nullable', 'image', 'max:2048'],
            'vap' => ['nullable', 'mimes:pdf'],
            'letter' => ['nullable', 'mimes:pdf'],
            'bank_passbook' => ['nullable', 'mimes:pdf'],
            'gp_approved_copy' => ['nullable', 'mimes:pdf'],
        ]);

        if (auth()->user()->isAsrlmBlock()) {
            $blocks = auth()->user()->blocks->pluck('id')->all();
            if (!in_array($validatedData['block_id'], $blocks)) {
                return $this->notify('Please Enter Data for your Block Only', 'error');
            }
        }

        $activity = ActivityDetail::create($validatedData);

        if ($validatedData['minutes']) {
            $activity->update([
                'minutes' => $validatedData['minutes']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['resolution']) {
            $activity->update([
                'resolution' => $validatedData['resolution']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['attendance']) {
            $activity->update([
                'attendance' => $validatedData['attendance']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['photo1']) {
            $activity->update([
                'photo1' => $validatedData['photo1']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['photo2']) {
            $activity->update([
                'photo2' => $validatedData['photo2']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['committee_photo']) {
            $activity->update([
                'committee_photo' => $validatedData['committee_photo']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['members']) {
            $activity->update([
                'members' => $validatedData['members']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['message']) {
            $activity->update([
                'message' => $validatedData['message']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['pra']) {
            $activity->update([
                'pra' => $validatedData['pra']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['vap']) {
            $activity->update([
                'vap' => $validatedData['vap']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['letter']) {
            $activity->update([
                'letter' => $validatedData['letter']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['bank_passbook']) {
            $activity->update([
                'bank_passbook' => $validatedData['bank_passbook']->storePublicly('/', 'activity'),
            ]);
        }
        if ($validatedData['gp_approved_copy']) {
            $activity->update([
                'gp_approved_copy' => $validatedData['gp_approved_copy']->storePublicly('/', 'activity'),
            ]);
        }
        $this->banner('Activity Details Added Successfully');
        return redirect()->route('activityDetails.show', $activity->id);
    }

    public function render()
    {
        return view('livewire.activity-details.create', [
            'phases' => ActivityDetail::getPhaseOptions(),
            'categories' => ActivityDetail::getCategoryOptions(),
            'appliedOptions' => ActivityDetail::getAppliedOptions(),
        ]);
    }
}
