<?php

namespace App\Http\Livewire\Labs;

use App\Models\Lab;
use Livewire\Component;

class Labs extends Component
{
    public function render()
    {
        return view('livewire.labs.labs', [
            'labs' => Lab::query()
                ->with(['circle'])
                ->latest('id')
               // ->limit(8)
                ->get(),
        ]);
    }
}
