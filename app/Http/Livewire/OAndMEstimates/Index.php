<?php

namespace App\Http\Livewire\OAndMEstimates;

use App\Models\OAndMEstimate;
use Livewire\Component;

class Index extends Component
{
    public $wuc;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.o-and-m-estimates.index', [
            'estimates' => OAndMEstimate::query()
                ->with('financialYear')
                ->where('wuc_id', $this->wuc)
                ->get(),
        ]);
    }
}
