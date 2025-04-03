<?php

namespace App\Http\Livewire\ActivityDetails;

use Livewire\Component;

class Isas extends Component
{
    public $isas;
    public $activity;

    public function mount($activity)
    {
        $this->activity = $activity->loadMissing('isas');
        $this->isas = $this->activity->isas;
    }

    public function render()
    {
        return view('livewire.activity-details.isas');
    }
}
