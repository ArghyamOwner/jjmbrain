<?php

namespace App\Http\Livewire\Labs;

use App\Models\Lab;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = [
        'search' => ['except' => '']
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.labs.index', [
            'labs' => Lab::query()
                ->with(['circle'])
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
