<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\Trainer;
use Livewire\Component;
use App\Models\Jalshala;
use App\Traits\InteractsWithBanner;

class EditPreJalshala extends Component
{
    use InteractsWithBanner;

    public $jalshalaId;
    public $districtId;

    public $dayOne;
    public $dayTwo;
    public $trainerOne;
    public $trainerTwo;
    public $venue;

    public function mount(Jalshala $jalshala)
    {
        $this->jalshalaId = $jalshala->id;
        $this->districtId = $jalshala->district_id;

        $this->dayOne = $jalshala->day_one?->format('Y-m-d\TH:i');
        $this->dayTwo = $jalshala->day_two?->format('Y-m-d\TH:i');
        $this->trainerOne = $jalshala->trainer_one_id;
        $this->trainerTwo = $jalshala->trainer_two_id;
        $this->venue = $jalshala->venue;
    }

    public function save()
    {
        $validated = $this->validate([
            'dayOne' => ['required', 'date_format:Y-m-d\TH:i'],
            'dayTwo' => ['required', 'date_format:Y-m-d\TH:i'],
            'trainerOne' => ['required'],
            'trainerTwo' => ['nullable'],
            'venue' => ['required'],
        ]);

        $this->jalshala->update([
            'day_one' => $validated['dayOne'],
            'day_two' => $validated['dayTwo'],
            'trainer_one_id' => $validated['trainerOne'],
            'trainer_two_id' => $validated['trainerTwo'],
            'venue' => $validated['venue'],
        ]);

        $this->banner('Pre Jal Shala Data updated.');

        return redirect()->route('jalshalas.show', $this->jalshalaId);
    }

    public function getJalshalaProperty()
    {
        return Jalshala::findOrFail($this->jalshalaId);
    }

    public function getTrainersProperty()
    {
        return Trainer::query()
            ->where('district_id', $this->districtId) // Jal Shalas district id
            ->pluck('trainer_name', 'id');
    }

    public function render()
    {
        return view('livewire.jalshalas.edit-pre-jalshala');
    }
}
