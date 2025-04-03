<?php

namespace App\Http\Livewire\Jalkosh;

use App\Models\JalkoshLink;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view('livewire.jalkosh.index', [
            'jalkoshLinks' => JalkoshLink::query()
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
