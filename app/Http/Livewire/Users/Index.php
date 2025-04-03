<?php

namespace App\Http\Livewire\Users;

use App\Models\User;
use App\Enums\UserRole;
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

    public function resetFilter()
    {
        $this->reset(['search']);
    }
    
    public function render()
    {
        return view('livewire.users.index', [
            'users' => User::query()
                ->with('school')
                ->when($this->search != '', fn ($query) => $query->whereLike(['name', 'email'], $this->search))
                ->where('role', UserRole::SUB_ADMIN)
                ->orderBy('name')
                ->fastPaginate()
        ]);
    }
}
