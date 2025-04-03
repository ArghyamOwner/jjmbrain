<?php

namespace App\Http\Livewire\Subtask;

use App\Models\Task;
use Livewire\Component;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use InteractsWithBanner;

    public $taskId;
    public $subtask_type;
    public $subtask_name;
    public $subtask_description;
    public $subtask_estimated_time;
    public $choiceDetails;
    public $choices;
    public $showForm = true;

    public function mount(Task $task)
    {
        $this->taskId = $task->id;
    }

    public function save()
    {
        $validated = $this->validate([
            'subtask_type' => ['required', 'in:text,date,choice'],
            'subtask_name' => ['required'],
            'subtask_estimated_time' => ['required', 'integer'],
            'subtask_description' => ['nullable'],
            'choices' => ['nullable', 'required_if:subtask_type,choice', 'array', 'min:1'],
            'showForm' => ['required', 'boolean']
        ]);

        $this->task->subtasks()->create([
            'type' => $validated['subtask_type'],
            'subtask_name' => $validated['subtask_name'],
            'subtask_estimated_time' => $validated['subtask_estimated_time'],
            'subtask_description' => $validated['subtask_description'],
            'options' => $validated['choices'] && count($validated['choices']) > 0 ? $validated['choices'] : null,
            'show_form' => $validated['showForm']
        ]);

        $this->banner('Subtask created successfully!');

        return redirect()->route('tasks.show', $this->taskId);
    }

    public function addChoice()
    {
        $validated = $this->validate([
            'choiceDetails' => ['required', 'string']
        ]);

        $this->choices[] = $validated['choiceDetails'];

        $this->reset('choiceDetails');
        $this->dispatchBrowserEvent('hide-modal');
    }

    public function removeChoice($value)
    {    
        $choices = collect($this->choices)->filter(fn($item) => $item != $value);
    
        $this->choices = $choices->values()->all();
    }

    public function getTaskProperty()
    {
        return Task::findOrFail($this->taskId);
    }

    public function render()
    {
        return view('livewire.subtask.create');
    }
}
