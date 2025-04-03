<?php

namespace App\Http\Livewire\Isa;

use App\Models\Isa;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Edit extends Component
{
    use InteractsWithBanner;

    public $isa;
    public $name;
    public $contact_name;
    public $contact_phone;

    public function mount(Isa $isa)
    {
        $this->isa = $isa;
        $this->name = $this->isa->name;
        $this->contact_name = $this->isa->contact_name;
        $this->contact_phone = $this->isa->contact_phone;
    }

    public function update(){
        $validatedData = $this->validate([
            'name' => ['required'],
            'contact_name' => ['required'],
            'contact_phone' => ['required'],
        ]);

        $this->isa->update($validatedData);
        $this->banner('ISA Details Updated Successfully');
        return redirect()->route('isa.show', $this->isa->id);
    }

    public function render()
    {
        return view('livewire.isa.edit');
    }
}
