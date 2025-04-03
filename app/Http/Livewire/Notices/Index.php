<?php

namespace App\Http\Livewire\Notices;

use App\Models\Notice;
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
        return view('livewire.notices.index', [
            'notices' => Notice::query()
                ->with('user')
                ->when(!auth()->user()->isAdministrator(), fn ($query) => $query->where('role', auth()->user()->role))
                ->fastPaginate()
        ]);
    }
}
