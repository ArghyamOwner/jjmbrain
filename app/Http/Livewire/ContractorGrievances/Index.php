<?php

namespace App\Http\Livewire\ContractorGrievances;

use App\Models\ContractorGrievance;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
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
        return view('livewire.contractor-grievances.index', [
            'grievances' => ContractorGrievance::query()
                ->with(['workorder', 'user.contractor'])
                ->when($this->search != '', fn($query) => $query->whereLike('user.name', $this->search))
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
