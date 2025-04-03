<?php

namespace App\Http\Livewire\Stocks;

use App\Models\Stock;
use App\Models\StockConsume;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Traits\InteractsWithBanner;
use App\Traits\InteractsWithSlideoverModal;

class Consume extends Component
{
    use InteractsWithSlideoverModal;
    use InteractsWithBanner;

    public $stockId;
    public $sourceItemQuantity;
    public $quantity;

    protected $listeners = [
        'addStockConsumedSlideover' => 'openModal'
    ];

    public function openModal(Stock $id)
    {
        $this->resetErrorBag();
        $this->show = true;
        $this->stockId = $id->id;
        $this->sourceItemQuantity = $id->quantity;
    }

    public function save()
    {
        $validated = $this->validate([
            'quantity' => ['required'],
        ]);

        if ($validated['quantity'] > $this->sourceItemQuantity) {
            $this->addError('quantity', 'Insufficient quantity in the source lab.');
            return;
        }

        try {
            return DB::transaction(function () use ($validated) {

                StockConsume::create([
                    'quantity' => $validated['quantity'],
                    'stock_id' => $this->stockId,
                    'user_id' => auth()->id()
                ]);

                $this->stock->decrement('quantity', $validated['quantity']);

                $this->reset();

                $this->emit('refreshStockConsumed');

                $this->banner('Saved.');

                $this->close();
            });
        } catch (\Exception $e) {
            $this->notify('Something went wrong. Try again' . $e->getMessage(), 'error');
        }
    }

    public function getStockProperty()
    {
        return Stock::query()->findOrFail($this->stockId);
    }

    public function render()
    {
        return view('livewire.stocks.consume', [
            'consumes' => StockConsume::query()
                ->where('stock_id', $this->stockId)
                ->get()
        ]);
    }
}
