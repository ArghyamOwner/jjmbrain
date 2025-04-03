<?php

namespace App\Http\Livewire\Jalshalas;

use App\Enums\JalshalaStatus;
use Livewire\Component;
use App\Models\Jalshala;
use Livewire\WithFileUploads;
use App\Models\JaldootAttendance;
use App\Traits\InteractsWithBanner;

class CreatePostJalshala extends Component
{
    use InteractsWithBanner;
    use WithFileUploads;

    public $jalshalaId;

    public $numberOfBoys;
    public $numberOfGirls;
    public $numberOfOthers;
    public $dayOneImage;
    public $dayTwoImage;

    public function mount(Jalshala $jalshala)
    {
        $this->jalshalaId = $jalshala->id;

        $genderCounts = JaldootAttendance::where('jalshala_id', $this->jalshalaId)
            ->join('jaldoots', 'jaldoot_attendances.jaldoot_id', '=', 'jaldoots.id')
            ->selectRaw('jaldoots.gender, COUNT(*) as count')
            ->groupBy('jaldoots.gender')
            ->get();

        $genderCounts = $genderCounts->pluck('count', 'gender');

        $this->numberOfBoys = $genderCounts->get('male', 0);
        $this->numberOfGirls = $genderCounts->get('female', 0);
        $this->numberOfOthers = $genderCounts->get('others', 0);
    }

    public function save()
    {
        $validated = $this->validate([
            'numberOfBoys' => ['required', 'integer'],
            'numberOfGirls' => ['required', 'integer'],
            'numberOfOthers' => ['required', 'integer'],
            'dayOneImage' => ['required', 'image', 'max:4048'],
            'dayTwoImage' => ['required', 'image', 'max:4048'],
        ]);

        $this->jalshala->update([
            'total_student_attended' => $validated['numberOfBoys'] + $validated['numberOfGirls'] + $validated['numberOfOthers'],
            'total_boys_attended' => $validated['numberOfBoys'],
            'total_girls_attended' => $validated['numberOfGirls'],
            'total_others_attended' => $validated['numberOfOthers'],
            'status' => JalshalaStatus::COMPLETED
        ]);

        if ($validated['dayOneImage']) {
            $this->jalshala->update([
                'day_one_image' => $validated['dayOneImage']->storePublicly('/', 'uploads')
            ]);
        }

        if ($validated['dayTwoImage']) {
            $this->jalshala->update([
                'day_two_image' => $validated['dayTwoImage']->storePublicly('/', 'uploads')
            ]);
        }

        $this->banner('Post Jal Shala data added.');

        return redirect()->route('jalshalas.show', $this->jalshalaId);
    }

    public function getJalshalaProperty()
    {
        return Jalshala::findOrFail($this->jalshalaId);
    }

    public function render()
    {
        return view('livewire.jalshalas.create-post-jalshala');
    }
}
