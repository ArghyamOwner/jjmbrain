<?php

namespace App\Http\Livewire\Meetings;

use App\Models\Meeting;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $title;
    public $date_time;
    public $venue;

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required', 'string'],
            'venue' => ['required', 'string'],
            'date_time' => ['required', 'date'],
        ]);

        $validated['user_id'] = auth()->id();

        Meeting::create($validated);

        $this->banner('Meeting created.');

        return redirect()->route('meetings');
    }

    public function render()
    {
        return view('livewire.meetings.create');
    }
}
