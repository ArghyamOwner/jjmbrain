<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\Jaldoot;
use Livewire\Component;
use App\Models\Jalshala;
use App\Models\JalshalaSchool;
use Illuminate\Validation\Rule;
use App\Models\JaldootAttendance;

class JalshalaSchoolsStudent extends Component
{
    public $student_name;
    public $student_phone;
    public $class;
    public $age;
    public $gender;
    public $jalshala_school_id;

    public $jalshalaId;
    public $jalshalaUin;

    public $schemes;
    public $scheme_id;

    public $dayOne;
    public $dayTwo;

    public $trainerOne;
    public $trainerTwo;

    public $jalshalaSchools;
    public $schemeDetails;

    public $venue;

    public function mount($jalshala)
    {
        $jalshala = Jalshala::with('jalshalaSchools', 'jaldootAttendances', 'schemes.user', 'trainerOne', 'trainerTwo')->findOrFail($jalshala);

        $this->jalshalaId = $jalshala->id;
        $this->jalshalaUin = $jalshala->jalshala_uin;

        $this->dayOne = $jalshala->day_one?->format('d/m/Y h:i A');
        $this->dayTwo = $jalshala->day_two?->format('d/m/Y h:i A');
        $this->trainerOne = $jalshala->trainerOne?->trainer_name;
        $this->trainerTwo = $jalshala->trainerTwo?->trainer_name;

        $this->jalshalaSchools = $jalshala->jalshalaSchools->map(fn ($data) => [
            'school_name' => $data->school_name,
            'teacher_name' => $data->teacher_name,
            'phone_number' => $data->phone_number
        ]);

        $this->schemeDetails =  $jalshala->schemes->map(fn ($data) => [
            'scheme_name' => $data->name,
            'jalmitra_name' => $data->user?->name,
            'jalmitra_phone' => $data->user?->phone

        ]);

        $this->venue = $jalshala->venue;

        $this->schemes = $jalshala->schemes->pluck('name', 'id');
    }


    public function save()
    {
        $validated = $this->validate([
            'student_name' => ['required'],
            'student_phone' => ['nullable', 'digits:10'],
            'class' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
            'gender' => ['required', 'in:male,female,others'],
            'jalshala_school_id' => ['required'],
            'scheme_id' => ['required', Rule::in(collect($this->schemes)->keys()->all())],

        ], [], [
            'scheme_id' => 'scheme',
            'student_name' => 'name',
            'student_phone' => 'phone'
        ]);

        $existingCount = Jaldoot::query()
            ->whereHas('jalshalaSchool', function ($q) {
                $q->where('jalshala_id', $this->jalshalaId);
            })->count();

        $uin = 'JD' . sprintf('%02d', ($existingCount + 1));

        $validated['jaldoot_uin'] = $this->jalshalaUin . $uin;

        Jaldoot::create($validated);

        $this->reset([
            'student_name',
            'student_phone',
            'class',
            'age',
            'gender',
            'jalshala_school_id'
        ]);

        $this->emit('refreshData');

        $this->notify('Student details added.');
    }

    public function attendance($jaldootId)
    {
        $jaldootAttendance = JaldootAttendance::query()
            ->where('jalshala_id', $this->jalshalaId)
            ->where('jaldoot_id', $jaldootId)
            ->exists();

        if (!$jaldootAttendance) {
            JaldootAttendance::create([
                'jalshala_id' => $this->jalshalaId,
                'jaldoot_id' => $jaldootId,
                'attended_at' => now()
            ]);

            $this->notify('Attendance Done.');
        }
    }

    public function render()
    {
        return view('livewire.jalshalas.jalshala-schools-student', [
            'jalshalaschools' => JalshalaSchool::with(['jaldoots.jalshalaSchool', 'jaldoots.latestJaldootAttendance', 'jaldoots.scheme'])->where('jalshala_id', $this->jalshalaId)->get()
        ])->layout('layouts.guest');
    }
}
