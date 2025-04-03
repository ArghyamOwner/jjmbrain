<?php

namespace App\Http\Livewire\MeetingMinutes;

use App\Models\MeetingMinute;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $meeting;
    public $minutes;

    public function mount(MeetingMinute $meeting)
    {
        $this->meeting = $meeting->load('createdBy');
    }

    public function minuteUpdate()
    {
        $validatedData = $this->validate([
            'minutes' => ['required', 'mimes:pdf']
        ]);

        $this->meeting->update([
            'minutes' => $validatedData['minutes']->storePublicly('/', 'uploads'),
            'minute_date' => now()
        ]);

        $this->banner('Meeting Minute added successfully.');
        return redirect()->route('meetingMinutes.show', $this->meeting->id);
    }
    
    public function render()
    {
        return view('livewire.meeting-minutes.show');
    }
}
