<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $type = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'type' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset([
            'search',
            'type',
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.office.index', [
            'officeTypes' => config('freshman.office_types'),
            'offices' => Office::query()
                ->when($this->search != '', fn($query) => $query->whereLike('name', $this->search))
                ->when($this->type != 'all', fn($query) => $query->where('type', $this->type))
                ->orderBy('name')
                ->fastPaginate(),
        ]);
    }
}
