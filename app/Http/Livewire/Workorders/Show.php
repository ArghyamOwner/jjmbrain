<?php

namespace App\Http\Livewire\Workorders;

use App\Models\Workorder;
use Livewire\Component;

class Show extends Component
{
    public $workorderId;

    public function mount(Workorder $workorder)
    {
        $this->workorderId = $workorder->id;
        $this->workorder = $workorder->loadMissing('circle', 'contractor.contractor', 'workdocuments');
    }

    protected $listeners = [
        'refreshWorkorder' => '$refresh',
        'refreshWorkorderStatus' => '$refresh',
    ];

    public function render()
    {
        return view('livewire.workorders.show'
            // 'workorder' => Workorder::with(['circle', 'contractor.contractor'])->findOrFail($this->workorderId),
        );
    }
}
