<?php

namespace App\Http\Livewire\Front;

use App\Models\Article;
use Livewire\Component;

class ArticleShow extends Component
{
    public $articleId;
    public $articleTitle;
    public $articleContent;
    public $categoryName;
    public $categorySlug;
    public $articleLastUpdatedAt;
    public $articleSummary;

    public function mount(Article $article)
    {
        $article->loadMissing('category');

        $this->articleId = $article->id;
        $this->articleTitle = $article->title;
        $this->articleContent = $article->content;
        $this->categoryName = $article?->category?->name;
        $this->categorySlug = $article?->category?->slug;
        $this->articleLastUpdatedAt = $article->updated_at->format('j M, Y');
        $this->articleSummary = $article->summary;
    }

    public function render()
    {
        return view('livewire.front.article-show')
            ->layout('layouts.help')
            ->layoutData([
                'title' => $this->articleTitle,
                'metaTitle' => $this->articleTitle,
                'metaDescription' => $this->articleSummary,
            ]);
    }
}
