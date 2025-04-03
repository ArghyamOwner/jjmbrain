<?php

namespace App\Http\Livewire\Stocks;

use App\Enums\ItemCategory;
use App\Models\Item;
use App\Models\Lab;
use App\Models\Stock;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $item;
    public $lab;
    public $category;

    protected $queryString = [
        'search' => ['except' => ''],
        'item' => ['except' => ''],
        'lab' => ['except' => ''],
        'category' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
        'refreshStockConsumed' => '$refresh'
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'category', 'item', 'lab']);
    }

    public function getItemTypesProperty()
    {
        return ItemCategory::cases();
    }

    public function getItemsProperty()
    {
        return Item::query()->orderBy('item_name')->pluck('item_name', 'id');
    }

    public function getLabsProperty()
    {
        return Lab::query()->orderBy('lab_name')->pluck('lab_name', 'id');
    }

    public function isAllowTransfer() {
        return auth()->user()->isAdministratorOrLabAdmin();
    }

    public function render()
    {
        return view('livewire.stocks.index', [
            'stocks' => Stock::query()
                ->with(['item', 'lab'])
                ->when(!auth()->user()->isAdministratorOrLabHoOrLabAdmin() , function ($query) {
                    $query->whereIn('lab_id', auth()->user()->labs()->pluck('lab_id'));
                })
                ->when($this->search != '', fn ($query) => $query->whereLike(['item.item_name', 'item.item_code'], $this->search))
                ->when($this->category != '', fn ($query) => $query->whereRelation('item', 'category', $this->category))
                ->when($this->item != '', fn ($query) => $query->whereRelation('item', 'id', $this->item))
                ->when($this->lab != '', fn ($query) => $query->whereRelation('lab', 'id', $this->lab))
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
