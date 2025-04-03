<?php

namespace App\Http\Livewire\Schools;

use App\Models\School;
use Livewire\Component;
use Livewire\WithPagination;
use App\Enums\SchoolCategory;
use App\Enums\AffiliatedBoards;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $category = 'all';
    // public $board = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => 'all'],
        // 'board' => ['except' => 'all'],
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

    public function getSchoolCategoriesProperty()
    {
        return SchoolCategory::cases();
    }

    public function getSchoolBoardsProperty()
    {
        return AffiliatedBoards::cases();
    }
    
    public function render()
    {
        return view('livewire.schools.index', [
            'schools' => School::query()
                ->with([
                    'district:id,name', 
                    'block:id,name',
                ])
                ->when($this->search != '', fn ($query) => $query->whereLike(['name'], $this->search))
                ->when($this->category != 'all', fn ($query) => $query->where('school_category', $this->category))
                // ->when($this->board != 'all', fn ($query) => $query->where('affiliated_board', $this->board))
                ->latest('id')
                ->fastPaginate(10)
        ]);
    }
}
