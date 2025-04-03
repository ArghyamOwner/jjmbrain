<?php

namespace App\Http\Livewire\MeetingMinutes;

use App\Models\MeetingMinute;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'refreshMeetings' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.meeting-minutes.index', [
            'meetings' => MeetingMinute::latest('id')->fastPaginate()
        ]);
    }
}
