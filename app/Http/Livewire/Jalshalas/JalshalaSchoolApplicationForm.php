<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\Scheme;
use App\Models\Jaldoot;
use Livewire\Component;
use App\Models\JalshalaSchool;
use Illuminate\Validation\Rule;

class JalshalaSchoolApplicationForm extends Component
{
    public $jalshalaschoolId;
    public $jalshalaUin;
    public $jalshalaId;

    public $student_name;
    public $student_phone;
    public $class;
    public $age;
    public $gender;
    public $scheme_id;

    public $schemes;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount($jalshalaschool)
    {
        $jalshalaschool = JalshalaSchool::with('jalshala.schemes')->findOrFail($jalshalaschool);

        $this->jalshalaschoolId = $jalshalaschool->id;
        $this->jalshalaUin = $jalshalaschool->jalshala?->jalshala_uin;

        $this->jalshalaId = $jalshalaschool->jalshala?->id;

        $this->schemes = $jalshalaschool->jalshala->schemes->pluck('name', 'id');
    }

    public function save()
    {
        $validated = $this->validate([
            'student_name' => ['required'],
            'scheme_id' => ['required', Rule::in(collect($this->schemes)->keys()->all())],
            'student_phone' => ['nullable', 'digits:10'],
            'class' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
            'gender' => ['required', 'in:male,female,others'],

        ], [], [
            'scheme_id' => 'scheme',
            'student_name' => 'name',
            'student_phone' => 'phone'
        ]);

        $validated['jalshala_school_id'] = $this->jalshalaschoolId;

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
            'scheme_id'
        ]);

        $this->emit('refreshData');

        $this->notify('Student details added.');
    }

    public function render()
    {
        return view('livewire.jalshalas.jalshala-school-application-form', [
            'jalshalaschool' => JalshalaSchool::with(['jalshala', 'jaldoots.scheme'])->findOrFail($this->jalshalaschoolId)
        ])->layout('layouts.guest');
    }
}
