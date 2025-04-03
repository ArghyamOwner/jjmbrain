<?php

namespace App\Http\Livewire\Subjects;

use App\Models\Video;
use Livewire\Component;
use App\Traits\WithSlideover;

class EditVideo extends Component
{
    use WithSlideover;

    public $videoId;
    public $title;
    public $description;
    public $image;
    public $link;
    public $imageUrl;

    protected $listeners = [
        'showEditVideoSlideover'
    ];

    public function showEditVideoSlideover(Video $video)
    {
        $this->videoId = $video->id;
        $this->title = $video->video_title;
        $this->description = $video->video_description;
        $this->imageUrl = $video->video_image_url;
        $this->link = $video->video_link;
        
        $this->toggle();
    }

    public function save()
    {
        $validated = $this->validate([
            'title' => ['required'],
            'link' => ['required', 'url'],
            'description' => ['nullable'],
            'image' => ['nullable', 'image', 'max:2024'],
        ]);

        $this->video->update([
            'video_title' => $validated['title'],
            'video_description' => $validated['description'],
            'video_link' => $validated['link']
        ]);

        if ($this->image) {
            $this->video->update([
                'video_image' => $this->image->store('/', 'uploads')
            ]);
        }

        $this->close();

        $this->dispatchBrowserEvent('destroy-filepond');
        $this->bannerMessage('Video details updated.');

        $this->emit('refreshData');
    }

    public function getVideoProperty()
    {
        return Video::findOrFail($this->videoId);
    }
    
    public function render()
    {
        return view('livewire.subjects.edit-video');
    }
}
