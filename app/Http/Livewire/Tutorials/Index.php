<?php

namespace App\Http\Livewire\Tutorials;

use App\Models\Tutorial;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.tutorials.index', [
            'tutorials' => Tutorial::query()
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
