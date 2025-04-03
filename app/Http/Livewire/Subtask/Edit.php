<?php

namespace App\Http\Livewire\Subtask;

use App\Models\Subtask;
use Livewire\Component;
use App\Traits\InteractsWithBanner;

class Edit extends Component
{
    use InteractsWithBanner;

    public $taskId;
    public $subtaskId;
    public $subtask_type;
    public $subtask_name;
    public $subtask_description;
    public $subtask_estimated_time;
    public $choiceDetails;
    public $choices;
    public $showForm = true;

    public function mount(Subtask $subtask)
    {
        $this->taskId = $subtask->task_id;
        $this->subtaskId = $subtask->id;
        $this->subtask_type = $subtask->type;
        $this->subtask_name = $subtask->subtask_name;
        $this->subtask_description = $subtask->subtask_description;
        $this->subtask_estimated_time = $subtask->subtask_estimated_time;
        $this->choices = $subtask->options;
        $this->showForm = $subtask->show_form;
    }

    public function save()
    {
        $validated = $this->validate([
            'subtask_type' => ['required', 'in:text,date,choice'],
            'subtask_name' => ['required'],
            'subtask_estimated_time' => ['required', 'integer'],
            'subtask_description' => ['nullable'],
            'choices' => ['nullable', 'array', 'min:1'],
            'showForm' => ['required', 'boolean']
        ]);
 
        $this->subtask->update([
            'type' => $validated['subtask_type'],
            'subtask_name' => $validated['subtask_name'],
            'subtask_estimated_time' => $validated['subtask_estimated_time'],
            'subtask_description' => $validated['subtask_description'],
            'options' => $validated['choices'] && count($validated['choices']) > 0 ? $validated['choices'] : null,
            'show_form' => $validated['showForm']
        ]);

        $this->banner('Subtask updated successfully!');

        return redirect()->route('tasks.show', $this->taskId);
    }

    public function getSubtaskProperty()
    {
        return Subtask::findOrFail($this->subtaskId);
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
    
    public function render()
    {
        return view('livewire.subtask.edit');
    }
}
