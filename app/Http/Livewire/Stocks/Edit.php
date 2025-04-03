<?php

namespace App\Http\Livewire\Stocks;

use App\Models\Lab;
use App\Models\Item;
use App\Models\Stock;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Traits\InteractsWithBanner;

class Edit extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $itemName;
    public $itemId;
    public $stockId;

    public $manufacturingDate;
    public $lab;
    public $expiryDate;
    public $quantity;
    public $receipt;
    public $minimumQtyAlert;
    public $itemCategory;

    public function mount(Stock $stock)
    {
        $stock->loadMissing(['item']);
 
        $this->itemName = "{$stock->item->item_name} ({$stock->item->item_code})";
        $this->itemId = $stock->item->item_id;
        $this->stockId = $stock->id;

        $this->manufacturingDate = $stock->manufacturing_date?->format('Y-m-d');
        $this->lab = $stock->lab_id;
        $this->expiryDate = $stock->expiry_date?->format('Y-m-d');
        $this->quantity = $stock->quantity;
        $this->minimumQtyAlert = $stock->minimum_quantity_alert;
        $this->itemCategory = $stock->item->category->value;
    }

    public function save()
    {
        $rules = [
            'manufacturingDate' => ['required', 'date_format:Y-m-d'],
            'lab' => ['required'],
            'quantity' => ['required'],
            'minimumQtyAlert' => ['required'],
            'receipt' => ['nullable', 'mimes:pdf']
        ];

        if (in_array($this->itemCategory, ['Chemical', 'Instrument'])) {
            $rules['expiryDate'] = ['required', 'date_format:Y-m-d'];
        }

        $validated = $this->validate($rules);

      //  dd($validated);

        // $validated = $this->validate([
        //     'manufacturingDate' => ['required', 'date_format:Y-m-d'],
        //     'lab' => ['required'],
        //     'expiryDate' => ['required', 'date_format:Y-m-d'],
        //     'quantity' => ['required'],
        //     'minimumQtyAlert' => ['required'],
        //     'receipt' => ['nullable', 'mimes:pdf'],
        // ]);

        try {
            return DB::transaction(function () use ($validated) {
                $this->stock->update([
                    'manufacturing_date' => $validated['manufacturingDate'],
                    'expiry_date' => $validated['expiryDate'] ?? null,
                    'quantity' => $validated['quantity'],
                    'minimum_quantity_alert' => $validated['minimumQtyAlert']
                ]);
    
                if ($validated['receipt']) {
                    $this->stock->update([
                        'stock_receipt' => $validated['receipt']->storePublicly('/', 'uploads')
                    ]);
                }

                $this->banner('Stock updated');

                return redirect()->route('stocks');
            });
         } catch (\Exception $e) {
            $this->notify('Something went wrong. Try again', 'error');
         }
    }

    public function getStockProperty()
    {
        return Stock::findOrFail($this->stockId);
    }

    public function getLabsProperty()
    {
        return Lab::pluck('lab_name', 'id');
    }

    public function render()
    {
        return view('livewire.stocks.edit');
    }
}
