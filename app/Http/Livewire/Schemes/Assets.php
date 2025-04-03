<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Asset;
use Livewire\Component;
use Livewire\WithPagination;

class Assets extends Component
{
    use WithPagination;

    public $schemeId;
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
        return view('livewire.schemes.assets', [
            'assets' => Asset::query()
                ->with('circle', 'financialYear')
                ->where('scheme_id', $this->schemeId)
                ->when($this->search != '', fn ($query) => $query->whereLike(['item_name', 'asset_uin'], $this->search))
                ->latest('id')
                ->fastPaginate(10)
        ]);
    }
}
