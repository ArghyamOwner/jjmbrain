<?php

namespace App\Http\Livewire\Grievances;

use App\Models\Grievance;
use App\Traits\InteractsWithBanner;
use App\Traits\InteractsWithSlideoverModal;
use Livewire\Component;

class CloseIssue extends Component
{
    use InteractsWithSlideoverModal;
    use InteractsWithBanner;

    public $remarks;
    public $status;

    public $grievanceId;

    protected $listeners = [
        'addIssueCloseSlideover' => 'openModal'
    ];

    public function openModal($id)
    {
        $this->resetErrorBag();
        $this->show = true;
        $this->grievanceId = $id;
    }

    public function save()
    {
        $validatedData = $this->validate([
            'remarks' => ['required'],
            'status' => ['required'],
        ]);

        // TODO : Send message to beneficiary on status close 

        $this->grievance->update([
            'remarks' => $validatedData['remarks'],
            'status' => $validatedData['status'],
            'closed_by' => auth()->id(),
            'closed_at' => now()
        ]);

        $this->reset();

        $this->emit('refreshIssueClosed');

        $this->banner('Saved.');

        $this->close();
    }

    public function getGrievanceProperty()
    {
        return Grievance::query()->findOrFail($this->grievanceId);
    }

    public function render()
    {
        return view('livewire.grievances.close-issue', [
            'statuses' => Grievance::getStatusOptions()
        ]);
    }
}
