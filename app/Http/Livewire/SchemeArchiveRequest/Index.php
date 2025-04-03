<?php

namespace App\Http\Livewire\SchemeArchiveRequest;

use App\Models\Division;
use App\Models\SchemeArchiveRequest;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $status = 'all';
    public $division = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
        'division' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset([
            'search',
            'division',
            'status',
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getDivisionsProperty()
    {
        return Division::query()->orderBy('name')->pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.scheme-archive-request.index', [
            'statusOptions' => SchemeArchiveRequest::getStatusOptions(),
            'requests' => SchemeArchiveRequest::query()
                ->with(['division', 'scheme:id,name', 'checkedBy:id,name'])
                ->when($this->search != '', fn($query) => $query->whereLike(['scheme_name'], $this->search))
                ->when($this->status != 'all', fn($query) => $query->where('status', $this->status))
                ->latest('id')
                ->fastPaginate(10),
        ]);
    }
}
