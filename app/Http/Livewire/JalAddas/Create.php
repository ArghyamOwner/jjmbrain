<?php

namespace App\Http\Livewire\JalAddas;

use App\Models\JalAdda;
use App\Models\Trainer;
use Livewire\Component;
use App\Enums\JalshalaType;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use InteractsWithBanner;

    public $district;
    public $dayOne;
    public $trainerOne;
    public $trainerTwo;
    public $venue;
    public $attendee;

    public $type;

    protected $queryString = [
        'type' => [
            'except' => ''
        ]
    ];

    public function mount()
    {
        $this->district = auth()->user()->districts->first()['id'];
    }

    public function save()
    {
        $validated = $this->validate([
            'dayOne' => ['required', 'date_format:Y-m-d\TH:i'],
            'trainerOne' => ['required'],
            'trainerTwo' => ['nullable'],
            'venue' => ['required'],
            'attendee' => ['required'],
            'type' => ['required', Rule::in(JalshalaType::values())]
        ]);

        JalAdda::create([
            'day_one' => $validated['dayOne'],
            'trainer_one_id' => $validated['trainerOne'],
            'trainer_two_id' => $validated['trainerTwo'],
            'venue' => $validated['venue'],
            'attendee' => $validated['attendee'],
            'district_id' => $this->district,
            'user_id' => auth()->id(),
            'type' => $validated['type']
        ]);

        $this->banner('Jal Adda created.');

        return redirect()->route('jaladdas.index');

    }

    public function getTrainersProperty()
    {
        return Trainer::query()
            ->where('district_id', $this->district)
            ->pluck('trainer_name', 'id');
    }

    public function render()
    {
        return view('livewire.jal-addas.create');
    }
}
