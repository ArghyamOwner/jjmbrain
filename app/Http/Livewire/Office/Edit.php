<?php

namespace App\Http\Livewire\Office;

use App\Models\Office;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;
    
    public $office;
    public $name;
    public $phone;
    public $address;
    public $latitude;
    public $longitude;
    public $image;

    public function mount(Office $office)
    {
        $this->office = $office;
        $this->name = $office->name;
        $this->address = $office->address;
        $this->phone = $office->phone;
        $this->latitude = $office->latitude;
        $this->longitude = $office->longitude;
        $this->image = $office->image;
    }

    public function update()
    {
        $validatedData = $this->validate([
            // 'name' => ['required'],
            'address' => ['required'],
            'phone' => ['nullable', 'digits:10' ],
            'latitude' => ['nullable', 'required_with:longitude', 'numeric'],
            'longitude' => ['nullable', 'required_with:latitude', 'numeric'],
            'image' => ['nullable', 'image', 'max:2048']
        ]);

        $this->office->update($validatedData);

        if ($this->image) {
            $this->office->update([
                'image' => $this->image->store('/', 'office')
            ]);
        }

        $this->banner('Office Edited Successfully.');
        return redirect()->route('offices');
    }

    public function render()
    {
        return view('livewire.office.edit');
    }
}
