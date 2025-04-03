<?php

namespace App\Http\Livewire\Transfers;

use Livewire\Component;
use App\Models\Transfer;
use Livewire\WithPagination;

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

    public function render()
    {
        return view('livewire.transfers.index', [
            'transfers' => Transfer::query()
                ->with(['transferedBy', 'acceptedBy', 'sourceLab', 'destinationLab', 'item'])
                ->when(!auth()->user()->isAdministratorOrStateJaldootCell(), function ($query) {
                    $query->whereIn('source_lab_id', auth()->user()->labs()->pluck('lab_id'))
                        ->orWhereIn('destination_lab_id', auth()->user()->labs()->pluck('lab_id'));
                })
                ->when($this->search != '', fn ($query) => $query->whereLike(['item.item_name'], $this->search))
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
