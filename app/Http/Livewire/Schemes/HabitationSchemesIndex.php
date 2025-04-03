<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Habitation;
use App\Traits\InteractsWithBanner;
use App\Traits\InteractsWithSlideoverModal;
use Livewire\Component;

class HabitationSchemesIndex extends Component
{
    use InteractsWithSlideoverModal;
    use InteractsWithBanner;

    public $habitation;

    protected $listeners = [
        'schemesOfHabitationSlideover' => 'openModal'
    ];

    public function openModal(Habitation $id)
    {
        $this->resetErrorBag();
        $this->show = true;
        $this->habitation = $id->loadMissing('schemes');
    }

    
    public function render()
    {
        return view('livewire.schemes.habitation-schemes-index');
    }
}
