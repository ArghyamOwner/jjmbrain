<?php

namespace App\Http\Livewire\Front;

use App\Models\Article;
use App\Models\ArticleCategory;
use Livewire\Component;

class CategoryArticlesList extends Component
{
    public $categoryId;
    public $categoryName;

    public function mount(ArticleCategory $category)
    {
        $this->categoryId = $category->id;
        $this->categoryName = $category->name;
    }
 
    public function render()
    {
        return view('livewire.front.category-articles-list', [
            'articles' => Article::query()
                ->with('category')
                ->where('category_id', $this->categoryId)
                ->whereNotNull('published_at')
                ->fastPaginate()
        ])->layout('layouts.help')->layoutData([
            'title' => 'Articles'
        ]);
    }
}
