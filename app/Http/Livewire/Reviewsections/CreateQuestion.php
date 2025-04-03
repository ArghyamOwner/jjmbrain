<?php

namespace App\Http\Livewire\Reviewsections;

use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\ReviewSection;
use App\Models\ReviewQuestion;
use Illuminate\Validation\Rule;
use App\Models\ReviewQuestionOption;

class CreateQuestion extends Component
{
    public $reviewsectionId;
    public $title;
    public $question;
    public $marks;
    public $questionOptions = [];
    public $option;
    
    public function mount(ReviewSection $reviewsection)
    {
        $this->reviewsectionId = $reviewsection->id;
        $this->title = $reviewsection->title;
    }

    public function save()
    {
        $validated = $this->validate([
            'question' => ['required'],
            'questionOptions' => ['required', 'array', 'min:2'],
        ]);

        // dd($validated);

        $reviewQuestion = ReviewQuestion::create([
            'review_section_id' => $this->reviewsectionId,
            'question' => $validated['question'],
            // 'marks' => $validated['marks']
        ]);

        foreach ($validated['questionOptions'] as $questionOptionIndex => $questionOption) {
            ReviewQuestionOption::create([
                'review_question_id' => $reviewQuestion->id,
                'option' => $questionOption['value'],
                'marks' => $questionOption['marks'],
                'order' => $questionOption['order'] ?? $questionOptionIndex + 1
            ]);
        }

        $this->reset(['question', 'marks', 'questionOptions']);

        $this->notify('Question with options added.');

        $this->emit('$refresh');
    }

    public function removeOption($value)
    {
        $this->questionOptions = collect($this->questionOptions)->filter(fn($item) => $item['value'] !== $value)->all();
    }

    public function updateOptionOrder($value)
    {
        $this->questionOptions = $value;
    }

    public function addOption()
    {
        $validated = $this->validate([
            'option' => ['required', function ($attribute, $value, $fail) {
                if (collect($this->questionOptions)->pluck('value')->contains($value)) {
                    return $fail("$value is already added.");
                }
            }],
            'marks' => ['required', 'numeric'],
        ]);

        $this->resetValidation('questionOptions');

        $this->questionOptions[] = [
            'value' => $validated['option'],
            'marks' => $validated['marks']
        ];
 
        $this->reset(['option', 'marks']);

        $this->dispatchBrowserEvent('hide-modal');
    }

    public function render()
    {
        return view('livewire.reviewsections.create-question');
    }
}
