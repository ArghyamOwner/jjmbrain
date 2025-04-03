<?php

namespace App\Http\Livewire\Assets;

use App\Models\Asset;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.assets.index', [
            'assets' => Asset::query()
                ->with(['circle', 'financialYear', 'scheme'])
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
