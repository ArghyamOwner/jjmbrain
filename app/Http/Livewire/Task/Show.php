<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;

class Show extends Component
{   
    public $taskId;

    public function mount(Task $task)
    {
        $this->taskId = $task->id;   
    }

    public function render()
    {
        return view('livewire.task.show', [
            'task' => Task::with(
                'subtasks', 
                'activity', 
                'assignmentTask.workorder:id,workorder_number', 
                'assignmentTask.scheme:id,name,division_id',
                'assignmentTask.scheme.division',
                'assignmentTask.user:id,name,phone'
            )->findOrFail($this->taskId)
        ]);
    }
}
