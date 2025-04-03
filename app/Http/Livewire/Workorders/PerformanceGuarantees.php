<?php

namespace App\Http\Livewire\Workorders;

use Livewire\Component;
use App\Models\PerformanceGuarantee;
use Livewire\WithPagination;

class PerformanceGuarantees extends Component
{
    use WithPagination;
    
    public $workorderId;
    public $workorderStatus;
    public $workorderPgAmount;
    public $search;
    public $status;

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => '']
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'status']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        return view('livewire.workorders.performance-guarantees', [
            'performanceGuarantees' => PerformanceGuarantee::query()
                // ->with(['circle', 'workorder'])
                // ->with(['workorders.circle'])
                ->when($this->search != '', fn ($query) => $query->whereLike(['pg_number'], $this->search))
                ->when($this->status == 'withdrawn', fn ($query) => $query->whereNotNull('withdrawn_at'))
                ->when($this->status == 'not-withdrawn', fn ($query) => $query->whereNull('withdrawn_at'))
                ->whereRelation('workorders','workorder_id', $this->workorderId)
                ->latest('id')
                ->get()
        ]);
    }
}
