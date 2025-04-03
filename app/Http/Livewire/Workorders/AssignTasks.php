<?php

namespace App\Http\Livewire\Workorders;

use App\Models\Activity;
use App\Models\AssignmentSubtask;
use App\Models\AssignmentTask;
use App\Models\Subtask;
use App\Models\Task;
use App\Models\Workorder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class AssignTasks extends Component
{
    public $workorderId;
    public $task;
    public $scheme;
    public $activity_id;
    public $tasks = [];
    public $subtasks = [];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(Workorder $workorder)
    {
        $this->workorderId = $workorder->id;
    }

    public function getActivitiesProperty()
    {
        return Activity::orderBy('name')->typeTask()->pluck('name', 'id')->all();
    }

    public function updatedActivityId()
    {
        // $this->tasks = Task::with('subtasks')->where('activity_id', $this->activity_id)->get();
        $this->tasks = Task::where('activity_id', $this->activity_id)
            ->get()
            ->map(fn($item) => [
                'label' => $item->task_name,
                'value' => $item->id
            ])
            ->all() ?? [];
    }

    // public function updatedTask($value)
    // {
    //     dd($value);
    //     // $this->subtasks = $this->task->subtasks ?? [];
    //     $this->subtasks = $this->task->subtasks ?? [];
    // }

    public function save()
    {
        $validated = $this->validate([
            'scheme' => [
                'required',
                // Rule::unique('assignment_tasks', 'scheme_id')
                //     ->where('scheme_id', '!=', $this->scheme)
                //     ->where('workorder_id', '!=', $this->workorderId)
            ],
            'activity_id' => ['required'],
            'task' => [
                'required',
                'array',
                'min:1'
                // Rule::unique('assignment_tasks', 'task_id')
                //     ->where('workorder_id', '!=', $this->workorderId)
            ],
        ], [], [
            'activity_id' => 'activity'
        ]);

        try {
            DB::transaction(function () use ($validated) {
                // $assignmentTask = AssignmentTask::create([
                //     'user_id' => auth()->id(),
                //     'scheme_id' => $validated['scheme'],
                //     'workorder_id' => $this->workorderId,
                //     'task_id' => $validated['task'],
                // ]);

                // $assignmentTask = AssignmentTask::updateOrCreate(
                //     [
                //         'scheme_id' => $validated['scheme'],
                //         'workorder_id' => $this->workorderId,
                //         'task_id' => $validated['task'],
                //     ],
                //     [
                //         'user_id' => auth()->id(),
                //         'scheme_id' => $validated['scheme'],
                //         'workorder_id' => $this->workorderId,
                //         'task_id' => $validated['task'],
                //     ]
                // );

                $assignmentTaskIds = [];

                foreach ($validated['task'] as $task) {
                    $assignmentTask = AssignmentTask::create([
                        'user_id' => auth()->id(),
                        'scheme_id' => $validated['scheme'],
                        'workorder_id' => $this->workorderId,
                        'task_id' => $task,
                    ]);

                    $subtasks = Subtask::where('task_id', $task)->get();
                    
                    foreach ($subtasks as $subtask) {
                        AssignmentSubtask::updateOrCreate(
                            [
                                'assignment_task_id' => $assignmentTask->id,
                                'subtask_id' => $subtask->id,
                            ],
                            [
                                'assignment_task_id' => $assignmentTask->id,
                                'workorder_id' => $this->workorderId,
                                'subtask_id' => $subtask->id,
                            ]
                        );
                    }
                }
            });

            $this->reset(['task', 'scheme', 'activity_id']);
            $this->notify('Task assigned to workorder');
            $this->dispatchBrowserEvent('reset-virtual-select');

            $this->emit('refreshData');
        } catch (\Exception $e) {
            $this->notify('Something went wrong. Try again.', 'error');
        }
    }

    public function getWorkorderProperty()
    {
        return Workorder::with('schemes')->findOrfail($this->workorderId);
    }

    // public function getTasksProperty()
    // {
    //     return Task::with('subtasks')->get();
    // }

    // public function getSubtasksProperty()
    // {
    //     $task = $this->tasks->where('id', $this->task)->first();

    //     return $task->subtasks ?? [];
    // }

    public function render()
    {
        return view('livewire.workorders.assign-tasks', [
            'assignedTasks' => AssignmentTask::query()
                ->with(['scheme', 'assignmentSubtasks.subtask', 'task'])
                ->where('workorder_id', $this->workorderId)
                ->latest('id')
                ->get()
                ->groupBy('scheme.name'),
            'schemes' => $this->workorder->schemes ?? [],
        ]);
    }
}
