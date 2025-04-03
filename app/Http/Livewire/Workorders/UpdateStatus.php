<?php

namespace App\Http\Livewire\Workorders;

use App\Enums\WorkorderStatus;
use App\Models\Workorder;
use Livewire\Component;
use App\Traits\InteractsWithBanner;
use App\Traits\InteractsWithSlideoverModal;

class UpdateStatus extends Component
{
    use InteractsWithSlideoverModal;
    use InteractsWithBanner;

    public $workorderId;
    public $status;
    
    protected $listeners = [
        'updateWorkorderStatusSlideover' => 'openModal'
    ];

    public function openModal($id)
    {
        $this->resetErrorBag();
        $this->show = true;
        $this->workorderId = $id;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'status' => ['required'],
        ]);

        $this->workorder->update([
            'workorder_status' => $validatedData['status'],
        ]);

        $this->reset();
        $this->emit('refreshWorkorderStatus');
        $this->banner('Saved.');
        $this->close();
    }

    public function getWorkorderProperty()
    {
        return Workorder::findOrFail($this->workorderId);
    }

    public function getWorkorderStatusesProperty()
    {
        return WorkorderStatus::cases();
    }
    
    public function render()
    {
        return view('livewire.workorders.update-status');
    }
}
