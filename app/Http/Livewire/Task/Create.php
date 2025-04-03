<?php

namespace App\Http\Livewire\Task;

use App\Enums\TaskCategory;
use App\Models\Activity;
use App\Models\Task;
use App\Traits\InteractsWithBanner;
use Illuminate\Validation\Rules\Enum;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $category;
    public $task_name;
    public $task_doc;
    public $task_description;
    public $activity_id;
    // public $task_estimated_time;

    public function save()
    {
        $validated = $this->validate([
            'category' => ['required', new Enum(TaskCategory::class)],
            'task_name' => ['required'],
            'task_doc' => ['required', 'mimes:pdf', 'max:5024'],
            'task_description' => ['nullable'],
            'activity_id' => ['required'],
            // 'task_estimated_time' => ['required', 'integer'],
        ]);

        $task = Task::create([
            'category' => $validated['category'],
            'task_name' => $validated['task_name'],
            // 'task_estimated_time' => $validated['task_estimated_time'],
            'task_description' => $validated['task_description'],
            'activity_id' => $validated['activity_id'],
        ]);

        if ($this->task_doc) {
            $task->update([
                'task_doc' => $this->task_doc->storePublicly('/', 'uploads'),
            ]);
        }

        $this->banner('Task created successfully!');

        return redirect()->route('tasks');
    }

    public function getCategoriesProperty()
    {
        return TaskCategory::cases();
    }

    public function getActivitiesProperty()
    {
        return Activity::orderBy('name')
            ->typeTask()
            ->whereNotIn('slug', ['dg_set', 'disinfection'])
            ->pluck('name', 'id')
            ->all();
    }

    public function render()
    {
        return view('livewire.task.create');
    }
}
