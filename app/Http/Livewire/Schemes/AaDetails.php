<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Scheme;
use App\Models\SchemeAa;
use Livewire\Component;

class AaDetails extends Component
{
    public $schemeId;

    public function mount(Scheme $scheme)
    {
        $this->schemeId = $scheme->id;       
    }

    public function render()
    {
        return view('livewire.schemes.aa-details', [
            'aaDetails' => SchemeAa::query()
                ->where('scheme_id', $this->schemeId)
                ->get()
        ]);
    }
}
