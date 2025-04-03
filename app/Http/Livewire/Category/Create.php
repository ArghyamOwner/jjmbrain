<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $name;

    public function save()
    {
        $validatedData = $this->validate([
            'name' => ['required']
        ]);

        $category = Category::create($validatedData);
        $this->banner('Category Created Successfully. Please Add Sub-Category Details Below.');
        return redirect()->route('category.show', $category->id);
    }

    public function render()
    {
        return view('livewire.category.create');
    }
}
