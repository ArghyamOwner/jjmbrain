<?php

namespace App\Http\Livewire\News;

use App\Models\News;
use Livewire\Component;
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
        return view('livewire.news.index', [
            'news' => News::with('user')
                ->when(!auth()->user()->isAdministrator(), fn ($query) => $query->where('user_id', auth()->id()))
                ->when($this->search != '', fn ($query) => $query->whereLike(['title'], $this->search))
                ->whereNull('deactivated_at')
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
