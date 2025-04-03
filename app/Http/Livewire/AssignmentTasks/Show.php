<?php

namespace App\Http\Livewire\AssignmentTasks;

use Livewire\Component;
use App\Models\AssignmentTask;
use App\Models\AssignmentSubtask;

class Show extends Component
{
    public $workorderId;
    public $assignmentTaskId;
    public $schemeName;
    public $assignmentTaskName;

    public function mount(AssignmentTask $assignmenttask)
    {
        $assignmenttask->load(['scheme', 'workorder', 'task']);

        $this->workorderId = $assignmenttask->workorder->id;
        $this->assignmentTaskId = $assignmenttask->id;
        $this->assignmentTaskName = $assignmenttask?->task?->task_name;
        $this->schemeName = $assignmenttask->scheme->name;
    }

    public function render()
    {
        return view('livewire.assignment-tasks.show', [
            'workorderSubtasks' => AssignmentSubtask::query()
                ->with(['user', 'subtask', 'workorder.contractor', 'assignmentTask.task', 'assignmentImages', 'assignmentReviews.user'])
                ->where('workorder_id', $this->workorderId)
                ->where('assignment_task_id', $this->assignmentTaskId)
                // ->whereNotNull('completed_at')
                // ->latest('id')
                ->orderBy('completed_at','desc')
                ->get()
        ]);
    }
}
