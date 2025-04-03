<?php

namespace App\Http\Livewire\Labs;

use App\Models\Lab;
use App\Models\Stock;
use Livewire\Component;
use App\Models\Transfer;

class Statistics extends Component
{
    public function render()
    {
        $labs = Lab::query()
        ->selectRaw("count(*) as total_labs")
        // ->selectRaw("count(case when status = 'pending' then 1 end) as pending")
        ->first();

        $stocks = Stock::query()
                ->with(['item', 'lab'])
                ->whereColumn('minimum_quantity_alert', '>=', 'quantity')
                ->orderBy('quantity')
                ->limit(8)
                ->get();

        $transfers = Transfer::query()
                ->with(['acceptedBy', 'sourceLab', 'destinationLab', 'item'])
                ->latest('id')
                ->limit(8)
                ->get();

        return view('livewire.labs.statistics',[
            'counts' => $labs,
            'stocks' => $stocks,
            'transfers' => $transfers
        ]);
    }
}