<?php

namespace App\Http\Livewire\Labs;

use App\Models\Transfer;
use Livewire\Component;

class StockTransfer extends Component
{
    public function render()
    {
        return view('livewire.labs.stock-transfer', [
            'transfers' => Transfer::query()
                ->with(['acceptedBy', 'sourceLab', 'destinationLab', 'item'])
                ->latest('id')
              //  ->limit(8)
                ->get(),
        ]);
    }
}
