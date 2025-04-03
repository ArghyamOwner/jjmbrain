<?php

namespace App\Http\Livewire\Stocks;

use App\Models\Lab;
use App\Models\Item;
use App\Models\Stock;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\DB;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $itemName;
    public $itemId;

    public $manufacturingDate;
    public $lab;
    public $expiryDate;
    public $quantity;
    public $receipt;
    public $minimumQtyAlert = 0;
    public $itemCategory;

    public function mount(Item $item)
    {
        $this->itemName = "$item->item_name ($item->item_code)";
        $this->itemId = $item->id;
        $this->itemCategory = $item->category->value;
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
                // if ($stock = Stock::where('item_id', $this->itemId)->first()) {
                //     $stock->increment('quantity', $validated['quantity']);
                //     $this->banner('Stock updated');
                // } else {

                    $stockAdded = Stock::create([
                        'item_id' => $this->itemId,
                        'lab_id' => $validated['lab'],
                        'manufacturing_date' => $validated['manufacturingDate'],
                        'expiry_date' => $validated['expiryDate'] ?? null,
                        'quantity' => $validated['quantity'],
                        'stock_flow' => 'procurement',
                        'minimum_quantity_alert' => $validated['minimumQtyAlert']
                    ]);

                    if ($validated['receipt']) {
                        $stockAdded->update([
                            'stock_receipt' => $validated['receipt']->storePublicly('/', 'uploads')
                        ]);
                    }

                    $this->banner('Stock saved');
               // }

                return redirect()->route('stocks');
            });
        } catch (\Exception $e) {
            $this->notify('Something went wrong. Try again' . $e->getMessage(), 'error');
        }
    }

    public function getItemProperty()
    {
        return Item::findOrFail($this->itemId);
    }

    public function getLabsProperty()
    {
        return Lab::query()
            ->when(!auth()->user()->isAdministratorOrStateJaldootCell(), function ($query) {
                $query->whereIn('id', auth()->user()->labs()->pluck('lab_id'));
            })
            ->pluck('lab_name', 'id');
    }

    public function render()
    {
        return view('livewire.stocks.create');
    }
}
