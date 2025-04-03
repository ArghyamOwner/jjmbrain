<?php

namespace App\Http\Livewire\WucVolunteers;

use App\Models\WucVolunteer;
use Livewire\Component;

class Index extends Component
{
    public $wuc;

    public function render()
    {
        return view('livewire.wuc-volunteers.index',[
            'volunteers' => WucVolunteer::query()
                ->where('wuc_id', $this->wuc)
                ->get()
        ]);
    }
}
