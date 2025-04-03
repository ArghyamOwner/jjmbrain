<?php

namespace App\Http\Livewire\Article;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ArticleCategory;
use Illuminate\Validation\Rule;
use App\Traits\WithFileAttachment;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;
    use WithFileAttachment;

    public $diskName = 'helpdesk';

    public $title;
    public $content;
    public $category;
    public $status;

    public function mount()
    {
        $this->status = 'visible';
    }

    public function save()
    {
        $validated = $this->validate([
            'category' => ['required'],
            'title' => ['required'],
            'content' => ['required'],
            'status' => ['required', Rule::in(['visible', 'hidden'])],
        ]);

        Article::create([
            'category_id' => $validated['category'], 
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_at' => $validated['status'] === 'visible' ? now() : null,
        ]);

        $this->banner('Article created.');

        return redirect()->route('articles');
    }

    public function getCategoriesProperty()
    {
        return ArticleCategory::orderBy('order')->pluck('name', 'id')->all();
    }

    public function render()
    {
        return view('livewire.article.create');
    }
}
