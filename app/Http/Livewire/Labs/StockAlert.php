<?php

namespace App\Http\Livewire\Labs;

use App\Models\Item;
use App\Models\Lab;
use App\Models\Stock;
use Livewire\Component;
use Livewire\WithPagination;

class StockAlert extends Component
{
    use WithPagination;

    public $search;
    public $lab = 'all';
    public $item = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'lab' => ['except' => 'all'],
        'item' => ['except' => 'all'],
    ];
    
    public function resetFilter()
    {
        $this->reset(['search', 'lab', 'item']);
    }

    public function getLabsProperty() {
        return  Lab::select('id','lab_name')->orderBy('lab_name')->get();
    } 

    public function getItemsProperty() {
        return  Item::select('id','item_name')->orderBy('item_name')->get();
    } 

    protected $listeners = [
        'refreshData' => '$refresh',
    ];
    
    public function render()
    {
        return view('livewire.labs.stock-alert', [
            'stocks' => Stock::query()
                ->with(['item', 'lab'])
                ->whereColumn('minimum_quantity_alert', '>=', 'quantity')
                ->when($this->search != '', fn($query) => $query->whereLike(['lab.lab_name'], $this->search))
                ->when($this->lab != 'all', fn($query) => $query->where('lab_id', $this->lab))
                ->when($this->item != 'all', fn($query) => $query->where('item_id', $this->item))
                ->orderBy('quantity')
                ->latest('id')
                ->fastPaginate()
        ]);
    }
}
