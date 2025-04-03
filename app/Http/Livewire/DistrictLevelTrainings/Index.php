<?php

namespace App\Http\Livewire\DistrictLevelTrainings;

use App\Models\DistrictLevelTraining;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view('livewire.district-level-trainings.index', [
            'districtLevelTrainings' => DistrictLevelTraining::query()
                ->with('trainerOne', 'trainerTwo', 'trainerThree', 'district')
                ->when(!auth()->user()->isAdministratorOrStateJaldootCell(), function ($query) {
                    $query->whereIn('district_id', auth()->user()->districts()->pluck('district_id'));
                })
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
