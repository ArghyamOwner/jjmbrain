<?php

namespace App\Http\Livewire\Tenants\News;

use App\Enums\NewsCategory;
use App\Models\News;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;

class Edit extends Component
{
    use WithFileUploads;

    public $newsId;
    public $category;
    public $title;
    public $summary;
    public $content;
    public $extraContent;
    public $featuredImage;
    public $featuredImageUrl;
    public $status;
    public $tags = [];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(News $news)
    {
        $this->newsId = $news->id;
        $this->category = $news->category;
        $this->title = $news->title;
        $this->summary = $news->summary;
        $this->content = $news->content;
        $this->extraContent = $news->extra_content;
        $this->featuredImageUrl = $news->featured_image_url;
        $this->tags = $news->meta['tags'] ?? [];
        $this->status = $news->published_at ? 'visible' : 'hidden';
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

        $this->news->update([
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

        if ($this->featuredImage) {
            $this->news->update([
                'featured_image' => $this->featuredImage->storePublicly('/', 'public'),
            ]);
        }

        $news = $this->news->refresh();
        $this->newsId = $news->id;
        $this->category = $news->category;
        $this->title = $news->title;
        $this->summary = $news->summary;
        $this->content = $news->content;
        $this->extraContent = $news->extra_content;
        $this->featuredImageUrl = $news->featured_image_url;
        $this->tags = $news->meta['tags'] ?? [];
        $this->status = $news->published_at ? 'visible' : 'hidden';

        $this->dispatchBrowserEvent('destroy-filepond');
        $this->notify('News updated successfully!');
        $this->emit('refreshData');
    }

    public function getNewsProperty()
    {
        return News::findOrFail($this->newsId);
    }

    public function getCategoriesProperty()
    {
        return NewsCategory::cases();
    }

    public function render()
    {
        return view('livewire.tenants.news.edit');
    }
}
