<?php

namespace App\Http\Livewire\Workorders;

use Livewire\Component;
use App\Models\Workorder;
use App\Models\AssignmentTask;
use App\Models\AssignmentSubtask;

class Progress extends Component
{
    public $workorderId;
    public $workorderNumber;

    public function mount(Workorder $workorder)
    {
        $this->workorderId = $workorder->id;
        $this->workorderNumber = $workorder->workorder_number;
    }

    public function render()
    {
        return view('livewire.workorders.progress', [
            'workorderTasks' => AssignmentTask::query()
                ->with(['scheme', 'task', 'workorder.contractor'])
                ->withCount([
                    'assignmentSubtasks as assignment_subtasks_count',
                    'assignmentSubtasks as completed_assignment_subtasks_count' => function ($query) {
                        $query->whereNotNull('completed_at');
                    }
                ])
                ->where('workorder_id', $this->workorderId)
                ->get()
                ->groupBy('scheme.name'),

            'workorderSubtasks' => AssignmentSubtask::query()
                ->with(['subtask', 'workorder.contractor', 'assignmentTask.task', 'assignmentImages'])
                ->where('workorder_id', $this->workorderId)
                ->whereNotNull('completed_at')
                ->latest('id')
                ->get()
        ]);
    }
}
