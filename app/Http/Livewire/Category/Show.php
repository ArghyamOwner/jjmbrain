<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use App\Models\SubCategory;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Show extends Component
{
    use InteractsWithBanner;
    public $category;
    public $subCategoryName;

    public function mount(Category $category)
    {
        $this->category = $category->loadMissing('subCategories');
    }

    public function save()
    {
        $validated = $this->validate([
            'subCategoryName' => ['required'],
        ]);
        SubCategory::create([
            'category_id' => $this->category->id,
            'name' => $this->subCategoryName,
        ]);
        $this->banner('Sub-Category Added.');
        return redirect()->route('category.show', $this->category->id);
    }

    public function render()
    {
        return view('livewire.category.show');
    }
}
