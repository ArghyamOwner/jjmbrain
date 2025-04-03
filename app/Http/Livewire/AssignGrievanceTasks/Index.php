<?php

namespace App\Http\Livewire\AssignGrievanceTasks;

use Livewire\Component;
use App\Models\Grievance;
use Livewire\WithPagination;
use App\Models\AssignGrievanceTask;

class Index extends Component
{
    use WithPagination;
    protected $listeners = [ 'refreshAssignedTask' => '$refresh' ];

    public $grievance;

    public function getGrievanceStatusProperty()
    {
        return Grievance::where('status', '!=', Grievance::STATUS_RESOLVED)
                    ->whereId($this->grievance)
                    ->wherehas('scheme', function($q){
                        $q->whereNotNull('work_status');
                    })
                  //->hasSchemeWorkStatus() //TODO
                    ->exists();
    }

    public function render()
    {
        return view('livewire.assign-grievance-tasks.index', [
            'tasks' => AssignGrievanceTask::query()
            ->with('assignedTo', 'assignedBy')
            ->where('grievance_id', $this->grievance)
            ->latest('id')
            ->fastPaginate(),
        ]);
    }
}