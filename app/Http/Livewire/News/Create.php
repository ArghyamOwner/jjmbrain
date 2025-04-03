<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $title;
    public $description;
    public $image;
    
    public function save()
    {
        $validatedData = $this->validate([
            'title' => ['required', 'string','max:255'],
            'description' => ['required'],
            'image'=> ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
        ]);
 
        $news = News::create([
            'user_id' => auth()->id(),
            'title' => $validatedData['title'],
            'description' => $validatedData['description']
        ]);

        if ($this->image) {
            $news->update([
                'image' => $this->image->storePublicly('/', 'uploads'),
            ]);
        }

        $this->banner('News created successfully!');

        return redirect()->route('news');
    }
    
    public function render()
    {
        return view('livewire.news.create');
    }
}
