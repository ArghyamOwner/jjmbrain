<?php

namespace App\Http\Livewire\Isa;

use App\Models\Isa;
use Livewire\Component;

class Show extends Component
{
    public $isa;
    public $showDeleteButton = true;

    public function mount(Isa $isa){
        $this->isa = $isa->load('block', 'district', 'villages', 'wucs.revenueCircle')->loadExists('activityDetails');
        if(auth()->user()->isWucAuditor()){
            $this->showDeleteButton = false;
        }
    }

    public function render()
    {
        return view('livewire.isa.show');
    }
}
