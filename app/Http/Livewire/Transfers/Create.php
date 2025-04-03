<?php

namespace App\Http\Livewire\Transfers;

use App\Models\Lab;
use App\Models\Stock;
use Livewire\Component;
use App\Models\Transfer;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use InteractsWithBanner;

    public $stockId;
    public $sourceLabName;
    public $sourceLabId;
    public $sourceItemName;
    public $sourceItemId;
    public $sourceItemQuantity;

    public $destinationLab;
    public $quantity;

    public function mount(Stock $stock)
    {
        $stock->loadMissing(['item', 'lab']);

        $this->stockId = $stock->id;
        $this->sourceLabName = $stock->lab->lab_name;
        $this->sourceLabId = $stock->lab->id;
        $this->sourceItemName = $stock->item->item_name;
        $this->sourceItemId = $stock->item->id;
        $this->sourceItemQuantity = $stock->quantity;
    }

    public function save()
    {
        $validated = $this->validate([
            'destinationLab' => ['required', 'exists:labs,id'],
            'quantity' => ['required'],
        ]);
 
        // Check if there is enough quantity in the source lab
        if ($validated['quantity'] > $this->sourceItemQuantity) {
            $this->addError('quantity', 'Insufficient quantity in the source lab.');
            return;
        }
    
        // Perform the transfer
        Transfer::create([
            'item_id' => $this->sourceItemId,
            'transferred_by' => auth()->user()->id,
            'source_lab_id' => $this->sourceLabId,
            'destination_lab_id' => $this->destinationLab,
            'quantity' => $this->quantity
        ]);

        $this->banner('Transfer request given.');

        return redirect()->route('transfers');
    }

    public function getLabsProperty()
    {
        return Lab::where('id', '!=', $this->sourceLabId)->get();
    }

    public function render()
    {
        return view('livewire.transfers.create');
    }
}
