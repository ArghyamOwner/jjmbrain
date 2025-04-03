<?php

namespace App\Http\Livewire\Schools;

use App\Models\Block;
use App\Models\School;
use Livewire\Component;
use App\Models\District;

class EditAddress extends Component
{
    public $schoolId;
    
    public $district;
    public $block;
    public $website;
    public $phone;
    public $email;
    public $streetAddress;
    public $village;
    public $city;
    public $postalCode;

    public $blocks = [];

    public function mount()
    {
        $this->district = $this->school->district_id;
        $this->block = $this->school->block_id;
        $this->website = $this->school->website;
        $this->phone = $this->school->phone;
        $this->email = $this->school->email;
        $this->streetAddress = $this->school->street_address;
        $this->village = $this->school->village;
        $this->city = $this->school->city;
        $this->postalCode = $this->school->postal_code;
    }

    public function save()
    {
        $validated = $this->validate([
            'district' => ['required'],
            'block' => ['required'],
            'website' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'streetAddress' => ['required'],
            'village' => ['required'],
            'city' => ['required'],
            'postalCode' => ['required', 'digits:6'],
        ]);

        $this->school->update([
            'district_id' => $validated['district'],
            'block_id' => $validated['block'],
            'website' => $validated['website'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'street_address' => $validated['streetAddress'],
            'city' => $validated['city'],
            'village' => $validated['village'],
            'state' => 'Arunachal Pradesh',
            'postal_code' => $validated['postalCode'],
        ]);

        $this->emit('refreshData');

        $this->notify('School address updated.');
    }

    public function getSchoolProperty()
    {
        return School::findOrFail($this->schoolId);
    }

    public function getDistrictsProperty()
    {
        return District::pluck('name', 'id');
    }

    public function render()
    {
        if ($this->district) {
            $this->blocks = Block::where('district_id', $this->district)->pluck('name', 'id');
        }
        
        return view('livewire.schools.edit-address');
    }
}
