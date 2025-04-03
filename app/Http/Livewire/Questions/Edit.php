<?php

namespace App\Http\Livewire\Questions;

use App\Models\Question;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $questionId;
    public $campaignId;
    // public $numberOfQuestions;
    public $question;
    // public $image;
    // public $imageUrl;
    public $option_1;
    public $option_2;
    public $option_3;
    public $option_4;
    // public $correct_answer;
    // public $marks;

    public function mount(Question $question)
    {
        $this->questionId = $question->id;
        $this->campaignId = $question->campaign_id;
        // $this->numberOfQuestions = $question->no_of_questions;
        $this->question = $question->question;
        // $this->image = $question->image;
        // $this->imageUrl = $question->image_url;
        $this->option_1 = $question->option_1;
        $this->option_2 = $question->option_2;
        $this->option_3 = $question->option_3;
        $this->option_4 = $question->option_4;
        // $this->correct_answer = $question->correct_answer;
        // $this->marks = $question->marks;
    }

    public function save()
    {
        $validated = $this->validate([
            'question' => ['required'],
            // 'image' => ['nullable', 'file', 'max:2024'],
            'option_1' => ['required'],
            'option_2' => ['required'],
            'option_3' => ['nullable'],
            'option_4' => ['nullable'],
            // 'correct_answer' => ['required'],
            // 'marks' => ['required', 'numeric'],
        ], [], [
            // 'correct_answer' => 'answer'
        ]);

        $this->questionModel->update([
            'question' => $validated['question'],
            'option_1' => $validated['option_1'],
            'option_2' => $validated['option_2'],
            'option_3' => $validated['option_3'],
            'option_4' => $validated['option_4'],
            // 'correct_answer' => $validated['correct_answer'],
            // 'marks' => $validated['marks'],
        ]);

        // if ($this->image) {
        //     $this->questionModel->update([
        //         'image' => $this->image->storePublicly('/', 'uploads')
        //     ]);
        // }

        // $this->dispatchBrowserEvent('destroy-filepond');

        $this->banner('Question updated.');

        return redirect()->route('campaigns.show', $this->campaignId);
    }

    public function getQuestionModelProperty()
    {
        return Question::findOrFail($this->questionId);
    }

    public function render()
    {
        return view('livewire.questions.edit');
    }
}
