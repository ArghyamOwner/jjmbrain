<?php

namespace App\Http\Livewire\JalAddas;

use App\Models\JalAdda;
use App\Models\Trainer;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Edit extends Component
{
    use InteractsWithBanner;
    
    public $district;
    public $dayOne;
    public $trainerOne;
    public $trainerTwo;
    public $venue;
    public $attendee;
    public $jaladdaId;

    public function mount(JalAdda $jaladda)
    {
        $this->dayOne = $jaladda->day_one->format('Y-m-d\TH:i');
        $this->trainerOne = $jaladda->trainer_one_id;
        $this->trainerTwo = $jaladda->trainer_two_id;
        $this->venue = $jaladda->venue;
        $this->attendee = $jaladda->attendee;
        $this->jaladdaId = $jaladda->id;
        $this->district = $jaladda->district_id;
    }

    public function update()
    {
        $validated = $this->validate([
            'dayOne' => ['required', 'date_format:Y-m-d\TH:i'],
            'trainerOne' => ['required'],
            'trainerTwo' => ['nullable'],
            'venue' => ['required'],
            'attendee' => ['required']
        ]);

        $this->jaladda->update([
            'day_one' => $validated['dayOne'],
            'trainer_one_id' => $validated['trainerOne'],
            'trainer_two_id' => $validated['trainerTwo'],
            'venue' => $validated['venue'],
            'attendee' => $validated['attendee'],
        ]);

        $this->banner('Jal Adda updated.');

        return redirect()->route('jaladdas.index');
    }

    public function getTrainersProperty()
    {
        return Trainer::query()
            ->where('district_id', $this->district)
            ->pluck('trainer_name', 'id');
    }

    public function getJaladdaProperty()
    {
        return JalAdda::findOrFail($this->jaladdaId);
    }

    public function render()
    {
        return view('livewire.jal-addas.edit');
    }
}
