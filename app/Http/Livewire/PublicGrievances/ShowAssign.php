<?php

namespace App\Http\Livewire\PublicGrievances;

use Livewire\Component;
use App\Models\Grievance;
use App\Models\AssignGrievanceTask;
use App\Traits\InteractsWithSlideoverModal;

class ShowAssign extends Component
{
    use InteractsWithSlideoverModal;
    public $grievanceId;

    protected $listeners = [
        'showAssignSlideover' => 'openModal'
    ];

    public function openModal($id)
    {
        $this->resetErrorBag();
        $this->show = true;
        $this->grievanceId = $id;
    }

    public function render()
    {
        return view('livewire.public-grievances.show-assign', [
            'tasks' => AssignGrievanceTask::query()
                ->with('assignedTo')
                ->where('grievance_id', $this->grievanceId)
                ->get()
        ]);
    }
}
