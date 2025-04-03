<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Division;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $role = 'all';
    public $division = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'role' => ['except' => 'all'],
        'division' => ['except' => 'all']
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'role', 'division']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getRolesProperty()
    {
        return collect(config('freshman.roles'))->filter(function ($item, $key) {
            return $key != 'admin' && $key != 'super-admin';
        })->sort();
    }

    public function getDivisionsProperty()
    {
        return Division::query()->pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.admin.users.index', [
            'users' => User::query()
                ->with(['offices', 'divisions', 'subdivisions'])
                ->when(auth()->user()->isTpaAdmin(), fn ($query) => $query->whereRelation('divisions', fn ($q) => $q->whereIn('division_id', auth()->user()->divisions()->pluck('division_id')))
                    ->where('role', 'third-party'))
                ->when(auth()->user()->isStateIsa(), fn ($query) => $query->whereIn('role', ['isa-coordinator', 'asrlm-block']))
                ->when(auth()->user()->isLabHo(), fn ($query) => $query->whereIn('role', ['lab-nodal-officer', 'lab-admin']))
                ->when($this->search != '', fn ($query) => $query->whereLike(['name', 'email', 'role', 'phone'], $this->search))
                ->when($this->role != 'all', fn ($query) => $query->where('role', $this->role))
                ->when($this->division != 'all', fn ($query) => $query->whereRelation('divisions', 'division_id', $this->division))
                ->where('role', '!=', 'admin')
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
