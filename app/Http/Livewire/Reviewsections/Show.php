<?php

namespace App\Http\Livewire\Reviewsections;

use App\Models\ReviewQuestion;
use App\Models\ReviewSection;
use Livewire\Component;
use Livewire\WithFileUploads;

class Show extends Component
{
    use WithFileUploads;

    public $reviewsectionId;
    public $title;
    public $type;
    public $userMarks;
    public $photo;
    public $photoUrl;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(ReviewSection $reviewsection)
    {
        $this->reviewsectionId = $reviewsection->id;
        $this->title = $reviewsection->title;
        $this->type = $reviewsection->type;
        $this->userMarks = $reviewsection->points;
        $this->photoUrl = $reviewsection->photoUrl;
    }

    public function getReviewSectionProperty()
    {
        return ReviewSection::findOrFail($this->reviewsectionId);
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required', 'string'],
            'type' => ['required', 'string', 'in:administrative,technical'],
            'userMarks' => ['required', 'numeric'],
            'photo' => ['nullable', 'image', 'max:4048'],
        ]);

        $this->reviewSection->update([
            'title' => $validated['title'],
            'type' => $validated['type'],
            'points' => $validated['userMarks'],
        ]);

        if ($validated['photo']) {
            $this->reviewSection->update([
                'photo' => $validated['photo']->storePublicly('/', 'uploads')
            ]);
        }

        $this->emit('$refresh');

        $this->notify('Review section title updated.');
    }

    public function updateQuestionOrder($values)
    {
        foreach($values as $value) {
            $reviewQuestion = ReviewQuestion::where('id', $value['value'])->first();

            if ($reviewQuestion) {
                $reviewQuestion->update([
                    'order' => $value['order']
                ]);
            }
        }

        $this->notify('Questions order updated.');
    }

    public function getReviewQuestionProperty()
    {
        return ReviewQuestion::wherefindOrFail();
    }

    public function render()
    {
        return view('livewire.reviewsections.show', [
            'questions' => ReviewQuestion::with('options')
                ->where('review_section_id', $this->reviewsectionId)
                ->orderBy('order')
                ->get()
        ]);
    }
}
