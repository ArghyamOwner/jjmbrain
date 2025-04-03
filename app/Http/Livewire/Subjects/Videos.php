<?php

namespace App\Http\Livewire\Subjects;

use App\Models\Video;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithFileUploads;

class Videos extends Component
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

        $this->subject->videos()->create([
            'video_title' => $validated['title'],
            'video_description' => $validated['description'],
            'video_link' => $validated['link'],
            'video_image' => $this->image ? $this->image->store('/', 'uploads') : null
        ]);

        $this->dispatchBrowserEvent('hide-modal');

        $this->bannerMessage('New video added.');

        $this->emit('$refresh');
    }
 
    public function getSubjectProperty()
    {
        return Subject::findOrFail($this->subjectId);
    }

    public function render()
    {
        return view('livewire.subjects.videos', [
            'videos' => Video::query()
                ->with('class')
                ->where('subject_id', $this->subjectId)
                ->fastPaginate()
        ]);
    }
}
