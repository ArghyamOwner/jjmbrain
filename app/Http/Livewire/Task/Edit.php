<?php

namespace App\Http\Livewire\Task;

use App\Models\Task;
use Livewire\Component;
use App\Enums\TaskCategory;
use App\Models\Activity;
use Livewire\WithFileUploads;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rules\Enum;

class Edit extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $category;
    public $taskId;
    public $task_name;
    public $task_doc;
    public $taskFile;
    public $task_description;
    public $task_estimated_time;
    public $taskUin;
    public $activity_id;

    public function mount(Task $task)
    {
        $this->taskId = $task->id;
        $this->taskUin = $task->task_uin;
        $this->category = $task->category;
        $this->task_name = $task->task_name;
        $this->task_description = $task->task_description;
        $this->activity_id = $task->activity_id;
        $this->task_estimated_time = $task->task_estimated_time;
        $this->taskFile= $task->task_doc ? $task->task_doc_url : '';
    }

    public function save()
    {
        $validated = $this->validate([
            'category' => ['required', new Enum(TaskCategory::class)],
            'task_name' => ['required'],
            'task_doc' => ['nullable', 'mimes:pdf', 'max:5024'],
            'task_description' => ['nullable'],
            'activity_id' => ['required'],
            // 'task_estimated_time' => ['required', 'integer'],
        ]);

        $this->task->update([
            'category' => $validated['category'],
            'task_name' => $validated['task_name'],
            // 'task_estimated_time' => $validated['task_estimated_time'],
            'task_description' => $validated['task_description'],
            'activity_id' => $validated['activity_id'],
        ]);

        if ($this->task_doc) {
            $this->task->update([
                'task_doc' => $this->task_doc->storePublicly('/', 'uploads')
            ]);
        }

        $this->banner('Task updated successfully!');

        return redirect()->route('tasks.edit', $this->task->id);
    }

    public function getTaskProperty()
    {
        return Task::findOrFail($this->taskId);
    }

    public function getCategoriesProperty()
    {
        return TaskCategory::cases();
    }

    public function getActivitiesProperty()
    {
        return Activity::orderBy('name')->typeTask()->pluck('name', 'id')->all();
    }
    
    public function render()
    {
        return view('livewire.task.edit');
    }
}
