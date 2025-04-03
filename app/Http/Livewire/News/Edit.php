<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $newsId;
    public $title;
    public $description;
    public $image;
    public $oldImage;
    public $featuredImage;

    public function mount(News $news)
    {
        $this->newsId = $news->id;
        $this->title = $news->title;
        $this->description = $news->description;
        $this->oldImage = $news->image;
        $this->featuredImage = $news->image ? $news->newsimage_url : null;
    }
    
    public function save()
    {
        $validatedData = $this->validate([
            'title' => ['required', 'string','max:255'],
            'description' => ['required'],
            'image'=> ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);
 
        $this->news->update([
            'title' => $validatedData['title'],
            'description' => $validatedData['description']
        ]);

        if ($this->image) {
            // if ($this->oldImage && Storage::disk('uploads')->exists($this->oldImage)) {
            //     Storage::disk('uploads')->delete($this->oldImage);
            // }

            $this->news->update([
                'image' => $this->image->storePublicly('/', 'uploads'),
            ]);

            $this->dispatchBrowserEvent('destroy-filepond');
        }

        $news = $this->news->refresh();
        $this->title = $news->title;
        $this->description = $news->description;
        $this->featuredImage = $news->image ? $news->newsimage_url : null;
 
        $this->notify('News updated successfully!');
    }

    public function getNewsProperty()
    {
        return News::findOrFail($this->newsId);
    }
    
    public function render()
    {
        return view('livewire.news.edit');
    }
}
