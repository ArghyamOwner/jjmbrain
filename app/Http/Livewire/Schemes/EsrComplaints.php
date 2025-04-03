<?php

namespace App\Http\Livewire\Schemes;

use App\Models\EsrComplaint;
use Livewire\Component;
use Livewire\WithPagination;

class EsrComplaints extends Component
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
        $esrComplaints = EsrComplaint::query()
            ->with('createdBy:id,name')
            ->where('scheme_id', $this->schemeId)
            ->when($this->search != '', fn ($query) => $query->whereLike(['tpi_agency_name', 'tpi_officer_name', 'tpi_officer_phone' ], $this->search))
            ->latest('id')
            ->fastPaginate(10);
        return view('livewire.schemes.esr-complaints', [
            'esrComplaints' => $esrComplaints
        ]);
    }
}
