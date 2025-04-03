<?php

namespace App\Http\Livewire\Schools;

use App\Models\Amenity;
use App\Models\School;
use Livewire\Component;
use App\Traits\WithSlideover;

class Show extends Component
{
    use WithSlideover;

    public $school;

    protected $listeners = [
        'showSchoolDetailsSlideover'
    ];

    public function showSchoolDetailsSlideover(School $school)
    {
        $school->load('district', 'block', 'amenities');

        $this->school = $school;

        $this->toggle();
    }

    public function getAmenitiesProperty()
    {
        $amenities = Amenity::pluck('name');

        return $amenities->map(function($item, $key) {
            if (! $this->school->amenities) {
                return [ 
                    'name' => $item,
                    'available' => false    
                ];
            } 

            if (collect($this->school->amenities->pluck('name'))->contains($item)) {
                return [  
                    'name' => $item,
                    'available' => true    
                ];
            } else {
                return [
                    'name' => $item,
                    'available' => false    
                ];
            }
        });
    }

    public function render()
    {
        return view('livewire.schools.show');
    }
}
