<?php

namespace App\Http\Livewire\Subjects;

use App\Models\Subject;
use Livewire\Component;
use App\Models\Textbook;
use Livewire\WithFileUploads;

class Textbooks extends Component
{   
    use WithFileUploads;

    public $subjectId;
    public $title;
    public $description;
    public $image;
    public $link;

    protected $listeners = [
        'refreshData' => '$refresh'  
    ];

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required'],
            'link' => ['required', 'url'],
            'description' => ['nullable'],
            'image' => ['required', 'image', 'max:2024'],
        ]);

        $this->subject->textbooks()->create([
            'textbook_title' => $validated['title'],
            'textbook_description' => $validated['description'],
            'textbook_link' => $validated['link'],
            'textbook_image' => $this->image ? $this->image->store('/', 'uploads') : null
        ]);

        $this->dispatchBrowserEvent('hide-modal');

        $this->bannerMessage('New textbook added.');

        $this->emit('$refresh');
    }

    public function getSubjectProperty()
    {
        return Subject::findOrFail($this->subjectId);
    }

    public function render()
    {
        return view('livewire.subjects.textbooks', [
            'textbooks' => Textbook::query()
                ->with('subject.class')
                ->where('subject_id', $this->subjectId)
                ->fastPaginate()
        ]);
    }
}
