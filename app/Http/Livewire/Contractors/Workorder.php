<?php

namespace App\Http\Livewire\Contractors;

use Livewire\Component;

class Workorder extends Component
{
    public $contractor;

    public function mount($contractor){
        $this->contractor = $contractor->loadMissing('workorders');
    }
    public function render()
    {
        return view('livewire.contractors.workorder');
    }
}
