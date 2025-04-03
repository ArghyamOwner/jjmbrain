<?php

namespace App\Http\Livewire\Category;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.category.index', [
            'categories' => Category::query()
                ->latest('id')
                ->fastPaginate(30),
        ]);
    }
}
