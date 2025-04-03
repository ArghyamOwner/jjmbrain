<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Wuc as ModelsWuc;
use Livewire\Component;
use Livewire\WithPagination;

class Wuc extends Component
{
    use WithPagination;

    public $schemeId;
    public $search;
    public $showDeleteButton = false;

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
        $user = auth()->user();
        if($user->isAdministrator() || $user->isAsrlmBlock() || $user->isIsaCoordinator() || $user->isStateIsa()){
            $this->showDeleteButton = true;
        }

        return view('livewire.schemes.wuc', [
            'wucs' => ModelsWuc::query()
                ->with('district', 'block', 'revenueCircle')
                ->whereHas('schemes', fn($q) => $q->where('scheme_id', $this->schemeId))
                ->when($this->search != '', fn($query) => $query->whereLike(['name'], $this->search))
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
