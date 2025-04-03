<?php

namespace App\Http\Livewire\Lithologs;

use App\Models\Division;
use App\Models\Litholog;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $schemeId;
    public $search;
    public $division = 'all';
    public $type = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'division' => ['except' => 'all'],
        'type' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset([
            'search',
            'division',
            'type',
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getDivisionsProperty()
    {
        $user = auth()->user();
        return Division::query()
            ->when((!$user->isAdministrator()),
                fn($query) => $query->whereIn('id', $user->divisions()->pluck('division_id')))
            ->orderBy('name')
            ->pluck('name', 'id');
    }

    public function render()
    {
        return view('livewire.lithologs.index', [
            'lithologs' => Litholog::query()
            // ->where('scheme_id', $this->schemeId)
                ->when($this->division != 'all', fn($query) => $query->whereRelation('scheme', 'division_id', $this->division))
                ->when($this->type === 'complete', fn($query) => $query->where('show_diagram', Litholog::SHOW_DIAGRAM))
                ->when($this->type === 'pending', fn($query) => $query->where('show_diagram', 0))
                ->when($this->search != '', fn($query) => $query->whereLike(['well_id'], $this->search))
            // ->when(!auth()->user()->isAdministrator(), fn($query) => $query->whereIn('division_id', auth()->user()->divisions()->pluck('division_id')))
                ->when(!auth()->user()->isAdministrator(), function ($query) {
                    $query->whereHas('scheme', function ($subQuery) {
                        $subQuery->whereIn('division_id', auth()->user()->divisions()->pluck('division_id'));
                    });
                })
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
