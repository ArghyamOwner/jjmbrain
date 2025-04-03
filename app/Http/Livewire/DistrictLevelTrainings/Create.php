<?php

namespace App\Http\Livewire\DistrictLevelTrainings;

use App\Models\DistrictLevelTraining;
use App\Models\Trainer;
use App\Traits\InteractsWithBanner;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    use InteractsWithBanner;

    public $dayOne;
    public $dayTwo;
    public $trainerOne;
    public $trainerTwo;
    public $trainerThree;
    public $dayOneImage;
    public $dayTwoImage;
    public $numberOfParticipant;

    public function save()
    { 
        $validated = $this->validate([
            'dayOne' => ['required', 'date_format:Y-m-d\TH:i'],
            'dayTwo' => ['nullable', 'date_format:Y-m-d\TH:i'],
            'trainerOne' => ['required'],
            'trainerTwo' => ['nullable'],
            'trainerThree' => ['nullable'],
            'numberOfParticipant' => ['required', 'integer'],
            'dayOneImage' => ['required', 'image', 'max:4048'],
            'dayTwoImage' => ['nullable', 'image', 'max:4048'],
        ]);

        $districtLevelTraining = DistrictLevelTraining::create([
            'day_one' => $validated['dayOne'],
            'day_two' => $validated['dayTwo'],
            'trainer_one_id' => $validated['trainerOne'],
            'trainer_two_id' => $validated['trainerTwo'],
            'trainer_three_id' => $validated['trainerThree'],
            'total_participant' => $validated['numberOfParticipant'],
            'user_id' => auth()->id(),
            'district_id' => auth()->user()->districts->first()['id']
        ]);

        if ($validated['dayOneImage']) {
            $districtLevelTraining->update([
                'day_one_image' => $validated['dayOneImage']->storePublicly('/', 'uploads')
            ]);
        }

        if ($validated['dayTwoImage']) {
            $districtLevelTraining->update([
                'day_two_image' => $validated['dayTwoImage']->storePublicly('/', 'uploads')
            ]);
        }

        $this->banner('District TOT data added.');
        return redirect()->route('districtleveltraings');

    }

    public function getTrainersProperty()
    {
        return Trainer::query()
            ->where('district_id', auth()->user()->districts->pluck('id'))
            ->pluck('trainer_name', 'id');
    }

    public function render()
    {
        return view('livewire.district-level-trainings.create');
    }
}
