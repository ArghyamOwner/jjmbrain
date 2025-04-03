<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Scheme;
use Livewire\Component;
use App\Models\SchemeInspection;

class Inspections extends Component
{
    public $schemeId;

    public function mount(Scheme $scheme)
    {
        $this->schemeId = $scheme->id;       
    }

    public function render()
    {
        return view('livewire.schemes.inspections', [
            'inspections' => SchemeInspection::query()
                ->with(['user', 'reviewSection'])
                ->where('scheme_id', $this->schemeId)
                ->get()
                ->groupBy('user.name')
        ]);
    }
}
