<?php

namespace App\Http\Livewire\Schools;

use App\Models\School;
use App\Models\Amenity;
use Livewire\Component;
use Illuminate\Support\Str;

class Amenities extends Component
{
    public $schoolId;
    public $facilities = [];

    public function mount()
    {
        $this->facilities = $this->getAmenities();
    }

    public function save()
    { 
        $this->validate([
            'facilities' => ['required', 'array']
        ]);

        $amenities = collect($this->facilities)
            ->filter(fn($item, $key) => $item == "true")
            ->map(fn($item, $key) => Str::of($key)->afterLast('|')->toString())
            ->values()
            ->all();
        
        $this->school->amenities()->sync($amenities);

        $this->notify('School amenities updated.');
    }

    public function getSchoolProperty()
    {
        return School::findOrFail($this->schoolId);
    }

    public function getAmenities()
    {
        $amenities = Amenity::pluck('name', 'id');

        return $amenities->flatMap(function($item, $key) {
            if (! $this->school->amenities) {
                return [ 
                    Str::slug($item) . '|' . $key  => "false"    
                ];
            } 

            if (collect($this->school->amenities->pluck('name'))->contains($item)) {
                return [  
                    Str::slug($item) . '|' . $key => "true"  
                ];
            } else {
                return [
                    Str::slug($item) . '|' . $key => "false"
                ];
            }
        })->all();
    }

    public function render()
    {
        return view('livewire.schools.amenities');
    }
}
