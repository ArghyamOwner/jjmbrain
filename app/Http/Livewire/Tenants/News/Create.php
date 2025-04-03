<?php

namespace App\Http\Livewire\Tenants\News;

use App\Models\News;
use Livewire\Component;
use App\Enums\NewsCategory;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use WithFileUploads;
    // use WithFileAttachment;
    use InteractsWithBanner;

    public $category;
    public $title;
    public $summary;
    public $content;
    public $extraContent;
    public $featuredImage;
    public $status;
    public $tags = [];

    public function mount()
    {
        $this->status = 'visible';
    }

    public function save()
    {
        $validatedData = $this->validate([
            'category' => ['required', 'string', Rule::in(NewsCategory::values())],
            'title' => ['required', 'string'],
            'summary' => ['required', 'string', 'max:200'],
            'content' => ['required'],
            'extraContent' => ['nullable'],
            'featuredImage' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2048'],
            'status' => ['required', Rule::in(['visible', 'hidden'])],
            'tags' => ['required', 'array'],
        ]);

        $news = News::create([
            'category' => $validatedData['category'],
            'summary' => $validatedData['summary'],
            'title' => $validatedData['title'],
            'content' => $validatedData['content'],
            'extra_content' => $validatedData['extraContent'],
            'meta' => [
                'tags' => $validatedData['tags'],
            ],
            'published_at' => $this->status === 'visible' ? now() : null,
        ]);

        $news->update([
            'slug' => Str::slug($this->title) . $news->id,
        ]);

        if ($this->featuredImage) {
            $news->update([
                'featured_image' => $this->featuredImage->storePublicly('/', 'public'),
            ]);
        }

        // $this->dispatchBrowserEvent('quill-clear-content');

        $this->banner('News created successfully!');

        return redirect()->route('tenant.news');
    }


    public function getCategoriesProperty()
    {
        return NewsCategory::cases();
    }
    
    public function render()
    {
        return view('livewire.tenants.news.create');
    }
}
