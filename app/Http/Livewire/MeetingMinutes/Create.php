<?php

namespace App\Http\Livewire\MeetingMinutes;

use App\Models\Meeting;
use App\Models\MeetingMinute;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $meeting_name;
    public $meeting_date;
    public $description;
    public $user_id;
    public $user_group;
    public $link;
    public $venue;
    public $pdf;
    public $meetingType;
    public $type;
    public $vertical;

    public function save()
    {
        $validatedData = $this->validate([
            'meeting_name' => ['required'],
            'meeting_date' => ['required'],
            'meetingType' => ['required'],
            'description' => ['required'],
            'user_id' => ['nullable'],
            'user_group' => ['nullable'],
            'link' => ['required_if:meetingType,Online'],
            'venue' => ['required_if:meetingType,Offline'],
            'pdf' => ['nullable'],
            'type' => ['required'],
            'vertical' => ['required'],
        ]);

        $meeting = MeetingMinute::create($validatedData + [
            'created_by' => Auth::id(),
        ]);

        $calMeeting = Meeting::create([
            'title' => $meeting->meeting_name,
            'venue' => $meeting->venue ?? $meeting->link,
            'date_time' => $meeting->meeting_date,
            'user_id' => Auth::id(),
        ]);

        $meeting->update([
            'meeting_id' => $calMeeting->id,
        ]);

        $this->banner('Meeting created.');
        return redirect()->route('meetingMinutes');
    }

    public function updatedMeetingType()
    {
        if ($this->meetingType == 'Online') {
            $this->reset(['venue']);
        }

        if ($this->meetingType == 'Offline') {
            $this->reset(['link']);
        }

    }

    public function getRolesProperty()
    {
        return collect(config('freshman.roles'))->filter(function ($item, $key) {
            return $key != 'admin' && $key != 'super-admin';
        })->sort();
    }

    public function render()
    {
        return view('livewire.meeting-minutes.create', [
            'typeOptions' => [
                'Online',
                'Offline',
            ],
            'meetingTypeOptions' => [
                'DC Review Meeting',
                'Divisional Review Meeting',
                'HO Review Meeting',
                'MD Review Meeting',
                'Minister Review Meeting',
                'Other',
            ],
            'verticalOptions' => MeetingMinute::getVerticalOptions()
        ]);
    }
}
