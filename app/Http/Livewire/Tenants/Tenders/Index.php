<?php

namespace App\Http\Livewire\Tenants\Tenders;

use App\Models\Tender;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.tenants.tenders.index', [
            'tenders' => Tender::query()
                ->when($this->search != '', fn ($query) => $query->whereLike(['name'], $this->search))
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
