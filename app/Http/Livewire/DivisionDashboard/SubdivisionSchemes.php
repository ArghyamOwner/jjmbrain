<?php

namespace App\Http\Livewire\DivisionDashboard;

use App\Models\Subdivision;
use Livewire\Component;

class SubdivisionSchemes extends Component
{
    public $divisionId;

    public function mount($division)
    {
        $this->divisionId = $division;
    }

    public function render()
    {
        return view('livewire.division-dashboard.subdivision-schemes', [
            'subdivisions' => Subdivision::where('division_id', $this->divisionId)->withCount('schemes')->get(),
        ]);
    }
}
