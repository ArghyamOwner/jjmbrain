<?php

namespace App\Http\Livewire\WucVolunteers;

use App\Models\WucVolunteer;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;
    
    public $wuc;
    public $name;
    public $phone;
    public $nature;
    public $is_trained;
    public $no_of_trainings;
    public $training_days;
    public $training_description;

    public $showTrainingFields = false;

    public function updatedIsTrained()
    {
        $this->reset('no_of_trainings', 'training_days', 'training_description');
        $this->showTrainingFields = false;

        if ($this->is_trained == WucVolunteer::YES) {
            $this->showTrainingFields = true;
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'name' => ['required'],
            'phone' => ['required'],
            'nature' => ['required'],
            'is_trained' => ['required'],
            'no_of_trainings' => ['nullable', 'required_if:is_trained,1'],
            'training_days' => ['nullable', 'required_if:is_trained,1'],
            'training_description' => ['nullable', 'required_if:is_trained,1'],
        ]);

        WucVolunteer::create($validatedData + [
            'wuc_id' => $this->wuc,
        ]);

        $this->banner('Volunteer Details added Successfully.');
        return redirect()->route('wucs.show', $this->wuc);
    }

    public function render()
    {
        return view('livewire.wuc-volunteers.create');
    }
}
