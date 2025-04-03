<?php

namespace App\Http\Livewire\ArticleCategories;

use Livewire\Component;
use App\Models\ArticleCategory;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use InteractsWithBanner;
    
    public $name;
    public $icon;
    public $description;

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'icon' => ['nullable'],
            'description' => ['nullable'],
        ]);

        $category = ArticleCategory::create($validated);
        $category->order = ArticleCategory::max('order') + 1;
        $category->save();

        $this->banner('Article category created.');

        return redirect()->route('articlecategories');
    }

    public function render()
    {
        return view('livewire.article-categories.create');
    }
}
