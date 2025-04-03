<?php

namespace App\Http\Livewire\Article;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\ArticleCategory;
use Illuminate\Validation\Rule;
use App\Traits\WithFileAttachment;
use App\Traits\InteractsWithBanner;

class Edit extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;
    use WithFileAttachment;

    public $diskName = 'helpdesk';

    public $articleId;
    public $title;
    public $content;
    public $category;
    public $status;

    public function mount(Article $article)
    {
        $this->articleId = $article->id;
        $this->title = $article->title;
        $this->content = $article->content;
        $this->category = $article->category_id;
        $this->status = $article->published_at ? 'visible' : 'hidden';
    }

    public function save()
    {
        $validated = $this->validate([
            'category' => ['required'],
            'title' => ['required'],
            'content' => ['required'],
            'status' => ['required', Rule::in(['visible', 'hidden'])],
        ]);

        $this->article->update([
            'category_id' => $validated['category'], 
            'title' => $validated['title'],
            'content' => $validated['content'],
            'published_at' => $validated['status'] === 'visible' ? now() : null,
        ]);

        $this->banner('Article updated.');

        $this->notify('Article updated.');

        $this->emit('$refresh');
        $this->emit('refreshData');
    }

    public function getArticleProperty()
    {
        return Article::findOrFail($this->articleId);
    }

    public function getCategoriesProperty()
    {
        return ArticleCategory::orderBy('order')->pluck('name', 'id')->all();
    }

    public function render()
    {
        return view('livewire.article.edit');
    }
}
