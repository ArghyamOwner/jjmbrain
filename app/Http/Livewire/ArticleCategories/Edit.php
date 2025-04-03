<?php

namespace App\Http\Livewire\ArticleCategories;

use App\Models\ArticleCategory;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Edit extends Component
{
    use InteractsWithBanner;

    public $categoryId;
    public $name;
    public $icon;
    public $description;

    public function mount(ArticleCategory $articlecategory)
    {
        $this->categoryId = $articlecategory->id;   
        $this->name = $articlecategory->name;   
        $this->icon = $articlecategory->icon;   
        $this->description = $articlecategory->description;   
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'icon' => ['nullable'],
            'description' => ['nullable'],
        ]);

        $this->articleCategory->update($validated);

        $this->banner('Article category updated.');

        return redirect()->route('articlecategories');
    }

    public function getArticleCategoryProperty()
    {
        return ArticleCategory::findOrFail($this->categoryId);
    }

    public function render()
    {
        return view('livewire.article-categories.edit');
    }
}
