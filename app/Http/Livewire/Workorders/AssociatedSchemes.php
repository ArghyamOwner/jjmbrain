<?php

namespace App\Http\Livewire\Workorders;

use Livewire\Component;
use App\Models\Workorder;

class AssociatedSchemes extends Component
{
    public $workorderId;
   
    public function getWorkorderProperty()
    {
        return Workorder::with([
            'schemes.district', 
            'schemes.block', 
            'schemes.division'
        ])->findOrFail($this->workorderId);
    }

    public function render()
    {
        return view('livewire.workorders.associated-schemes', [
            'schemes' => $this->workorder->schemes
        ]);
    }
}
