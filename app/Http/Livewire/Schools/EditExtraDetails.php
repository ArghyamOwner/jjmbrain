<?php

namespace App\Http\Livewire\Schools;

use App\Models\School;
use Livewire\Component;

class EditExtraDetails extends Component
{
    public $schoolId;
    public $totalLandArea;
    public $studentCapacity;
    public $totalToilets;
    public $functionalToilets;

    public function mount()
    {
        $this->totalLandArea = $this->school->total_land_area;
        $this->studentCapacity = $this->school->student_capacity;
        $this->totalToilets = $this->school->total_toilets;
        $this->functionalToilets = $this->school->total_functional_toilets;
    }

    public function save()
    {
        $validated = $this->validate([
            'totalLandArea' => ['required'],
            'studentCapacity' => ['required'],
            'totalToilets' => ['required'],
            'functionalToilets' => ['required'],
        ]);

        $this->school->update([
            'total_land_area' => $validated['totalLandArea'],
            'student_capacity' => $validated['studentCapacity'],
            'total_toilets' => $validated['totalToilets'],
            'total_functional_toilets' => $validated['functionalToilets'],
        ]);

        $this->emit('refreshData');

        $this->notify('School extra details updated.');
    }

    public function getSchoolProperty()
    {
        return School::findOrFail($this->schoolId);
    }

    public function render()
    {
        return view('livewire.schools.edit-extra-details');
    }
}
