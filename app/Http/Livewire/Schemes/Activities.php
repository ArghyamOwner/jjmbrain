<?php

namespace App\Http\Livewire\Schemes;

use App\Models\SchemeActivity;
use Livewire\Component;

class Activities extends Component
{
    public $schemeId;
    
    public function render()
    {
        return view('livewire.schemes.activities', [
            'activities' => SchemeActivity::query()
                ->with('user', 'scheme')
                ->where('scheme_id', $this->schemeId)
                ->latest('id')
                ->fastPaginate(10),
        ]);
    }
}
