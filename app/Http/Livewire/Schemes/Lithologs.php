<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Litholog;
use Livewire\Component;
use Livewire\WithPagination;

class Lithologs extends Component
{
    use WithPagination;

    public $schemeId;
    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
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
        return view('livewire.schemes.lithologs', [
            'lithologs' => Litholog::query()
                ->where('scheme_id', $this->schemeId)
                ->when($this->search != '', fn($query) => $query->whereLike(['well_id'], $this->search))
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
