<?php

namespace App\Http\Livewire\Grievances;

use Livewire\Component;

class ActorsNotWorking extends Component
{
    public function render()
    {
        return view('livewire.grievances.actors-not-working',[
            'actors' => []
        ]);
    }
}
