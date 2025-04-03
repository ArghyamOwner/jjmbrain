<?php

namespace App\Http\Livewire\Transfers;

use App\Models\Stock;
use Livewire\Component;
use App\Models\Transfer;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Accept extends Component
{
    use InteractsWithBanner;

    public $sourceLabName;
    public $destinationLabName;
    public $itemName;
    public $quantity;
    public $transferRequestedBy;
    public $transferRequestedDate;
    public $transferId;

    public function mount(Transfer $transfer)
    {
        if (!is_null($transfer->accepted_by)) {
            return redirect()->route('transfers');
        }

        $transfer->loadMissing(['transferedBy', 'acceptedBy', 'sourceLab', 'destinationLab', 'item']);

        $this->sourceLabName = $transfer->sourceLab?->lab_name;
        $this->destinationLabName = $transfer->destinationLab?->lab_name;
        $this->itemName = $transfer->item?->item_name;
        $this->quantity = $transfer->quantity;
        $this->transferRequestedBy = $transfer->transferedBy?->name;
        $this->transferRequestedDate = $transfer->created_at?->format('d/m/Y');
        $this->transferId = $transfer->id;
    }

    public function acceptTransfer()
    {
        try {
            return DB::transaction(function() {
                $transfer = $this->transferModel;
        
                // Decrement the quantity for requested items
                $stock = Stock::where('item_id', $transfer->item_id)
                    ->where('lab_id', $transfer->source_lab_id)
                    ->firstOrFail();
                $stock->decrement('quantity', $this->quantity);
                 
        
                // Find the item assocaited with the destination lab and increment the item quantity 
                // or else created a new item with the requested quantity
                $destinationStock = Stock::where('item_id', $transfer->item_id)
                    ->where('lab_id', $transfer->destination_lab_id)
                    ->first();
        
                if ($destinationStock) {
                    $destinationStock->increment('quantity', $this->quantity);
                    $destinationStock->update([
                        'stock_flow' => 'transfer'
                    ]);
        
                    $transfer->update([
                        'accepted_by' => auth()->id()
                    ]);
                } else {
                    Stock::create([
                        'user_id' => auth()->id(),
                        'item_id' => $transfer->item_id,
                        'lab_id' => $transfer->destination_lab_id,
                        'transfer_id' => $transfer->id,
                        'quantity' => $this->quantity,
                        'stock_flow' => 'transfer'
                    ]);
        
                    $transfer->update([
                        'accepted_by' => auth()->id()
                    ]);
                }

                $this->banner('Transfer accepted.');

                return redirect()->route('transfers');
            });
        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $this->notify('Something went wrong. Try again.', 'error');
        }
    }

    public function getTransferModelProperty()
    {
        return Transfer::findOrFail($this->transferId);
    }

    public function render()
    {
        return view('livewire.transfers.accept');
    }
}
