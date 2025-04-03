<?php

namespace App\Http\Livewire\Items;

use App\Models\Item;
use Livewire\Component;
use App\Enums\ItemCategory;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $category = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => 'all']
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'category']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getItemTypesProperty()
    {
        return ItemCategory::cases();
    }
    
    public function render()
    {
        return view('livewire.items.index', [
            'items' => Item::query()
                ->when($this->search != '', fn ($query) => $query->whereLike(['item_name', 'item_code'], $this->search))
                ->when($this->category != 'all', fn ($query) => $query->where('category', $this->category))
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
