<?php

namespace App\Http\Livewire\Contractors;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\ContractorDetail;

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

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.contractors.index', [
            'contractors' => ContractorDetail::query()
                ->with(['user'])
                ->when($this->search != '', fn ($query) => $query->whereLike(['user.name', 'entity_name', 'bid_no', 'user.email', 'user.phone'], $this->search))
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
