<?php

namespace App\Http\Livewire\Meetings;

use App\Models\Meeting;
use App\Traits\WithApiHelpers;
use Livewire\Component;

class Index extends Component
{
    use WithApiHelpers;
    
    protected $listeners = [
        'refreshMeetings' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.meetings.index', [
            'meetings' => Meeting::latest('id')->simplePaginate()
        ]);
    }
}
