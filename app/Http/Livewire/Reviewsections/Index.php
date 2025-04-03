<?php

namespace App\Http\Livewire\Reviewsections;

use App\Models\ReviewSection;
use Livewire\Component;

class Index extends Component
{
    public $title;

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required']
        ]);

        ReviewSection::create([
            'title' => $validated['title']
        ]);

        $this->reset('title');

        $this->dispatchBrowserEvent('hide-modal');

        $this->notify('Review section added.');
    }

    public function render()
    {
        return view('livewire.reviewsections.index', [
            'reviewsections' => ReviewSection::query()
                ->withCount('reviewQuestions')
                ->get()
        ]);
    }
}
