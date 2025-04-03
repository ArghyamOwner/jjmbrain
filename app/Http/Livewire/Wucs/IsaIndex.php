<?php

namespace App\Http\Livewire\Wucs;

use Livewire\Component;

class IsaIndex extends Component
{
    public $wuc;

    public function mount($wuc)
    {
        $this->wuc = $wuc->loadMissing('isas.block', 'isas.villages', 'isas.district');
    }

    public function render()
    {
        return view('livewire.wucs.isa-index');
    }
}
