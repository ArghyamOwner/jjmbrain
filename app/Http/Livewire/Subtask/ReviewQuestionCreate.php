<?php

namespace App\Http\Livewire\Subtask;

use App\Models\Subtask;
use Livewire\Component;
use App\Traits\InteractsWithBanner;

class ReviewQuestionCreate extends Component
{
    use InteractsWithBanner;

    public $taskId;
    public $subtaskId;

    public $question_type;
    public $question;
    public $description;
    public $choiceDetails;
    public $choices;
    public $showForm = true;

    public function mount(Subtask $subtask)
    {
        $this->taskId = $subtask->task_id;
        $this->subtaskId = $subtask->id;
    }

    public function save()
    {
        $validated = $this->validate([
            'question_type' => ['required', 'in:text,date,choice'],
            'question' => ['required'],
            'description' => ['nullable'],
            'choices' => ['nullable', 'array', 'min:1'],
            // 'showForm' => ['required', 'boolean']
        ]);
 
        $this->subtask->subtaskReviewQuestions()->create([
            'type' => $validated['question_type'],
            'question' => $validated['question'],
            'description' => $validated['description'],
            'options' => $validated['choices'] && count($validated['choices']) > 0 ? $validated['choices'] : null
        ]);

        $this->banner('Subtask review questions saved successfully!');

        return redirect()->route('subtasks.reviewQuestions', $this->subtaskId);
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
        return view('livewire.subtask.review-question-create');
    }
}
