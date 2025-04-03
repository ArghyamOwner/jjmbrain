<?php

namespace App\Http\Livewire\Questions;

use App\Models\Question;
use Livewire\Component;
use Livewire\WithFileUploads;

class Index extends Component
{
    use WithFileUploads;

    public $campaignId;
    public $numberOfQuestions;
    public $question;
    // public $image;
    public $option_1;
    public $option_2;
    public $option_3;
    public $option_4;
    // public $correct_answer;
    // public $marks;

    protected $listeners = [
        'refreshQuestions' => '$refresh',
    ];

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

        $question = Question::create([
            'campaign_id' => $this->campaignId,
            'question' => $validated['question'],
            'option_1' => $validated['option_1'],
            'option_2' => $validated['option_2'],
            'option_3' => $validated['option_3'],
            'option_4' => $validated['option_4'],
            // 'correct_answer' => $validated['correct_answer'],
            // 'marks' => $validated['marks'],
        ]);

        // if ($this->image) {
        //     $question->update([
        //         'image' => $this->image->storePublicly('/', 'uploads')
        //     ]);
        // }

        $this->reset([
            'question',
            // 'image',
            'option_1',
            'option_2',
            'option_3',
            'option_4',
            // 'correct_answer',
            // 'marks',
        ]);

        // $this->dispatchBrowserEvent('destroy-filepond');
        $this->dispatchBrowserEvent('hide-modal');
        $this->emit('refreshQuestions');
        $this->notify('Question added.');
    }

    public function render()
    {
        $questions = Question::where('campaign_id', $this->campaignId)->get();

        return view('livewire.questions.index', [
            'questions' => $questions,
            'questionsCount' => $questions->count(),
        ]);
    }
}
