<?php

namespace App\Http\Livewire\JalAddas;

use App\Models\School;
use App\Models\JalAdda;
use Livewire\Component;
use Illuminate\Support\Str;
use App\Models\EducationBlock;
use App\Models\JalAddaStudent;
use App\Traits\InteractsWithBanner;

class Student extends Component
{
    use InteractsWithBanner;

    public $district;
    public $educationBlock;
    public $schools = [];
    public $schoolId;
    public $student_name;
    public $gender;
    public $age;
    public $class;
    public $student_phone;
    public $jaladdaId;
    public $jaldoot_uin;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(JalAdda $jaladda)
    {
       $this->district = $jaladda->district_id;
       $this->jaladdaId = $jaladda->id;
    }

    public function getEducationBlocksProperty()
    {
        return EducationBlock::query()->where('district_id', $this->district)->pluck('block_name', 'id');
    }

    public function updatedEducationBlock($value)
    {
        $this->schools = School::query()->where('education_block_id', $value)
            ->where('category', '!=', '1 - Primary')
            ->get()
            ->map(fn ($item) => [
                "label" => $item->school_name,
                "value" => $item->id,
            ])->all();
    }

    public function save()
    {
        $validated = $this->validate([
            'student_name' => ['required'],
            'student_phone' => ['nullable', 'digits:10'],
            'class' => ['required', 'numeric'],
            'age' => ['required', 'numeric'],
            'gender' => ['required', 'in:male,female,others'],
            'schoolId' => ['required'],
            'educationBlock' => ['required'],
            'jaldoot_uin' => ['required'],

        ], [], [
            'student_name' => 'name',
            'student_phone' => 'phone',
            'schoolId' => 'school',
            'jaldoot_uin' => 'jaldoot id'
        ]);

        JalAddaStudent::create([
            'jal_adda_id' => $this->jaladdaId,
            'school_id' => $validated['schoolId'],
            'student_name' => $validated['student_name'],
            'student_phone' => $validated['student_phone'],
            'class' => $validated['class'],
            'age' => $validated['age'],
            'gender' => $validated['gender'],
            'jaldoot_uin' => Str::upper($validated['jaldoot_uin']),
        ]);

        $this->reset([
            'student_name',
            'student_phone',
            'class',
            'age',
            'gender',
            'schoolId',
            'educationBlock',
            'jaldoot_uin'
        ]);

        $this->banner('Jal Adda Student added.');

    }

    public function render()
    { 
        return view('livewire.jal-addas.student', [
            'jaladdaStudents' => JalAddaStudent::query()->with('school')->where('jal_adda_id', $this->jaladdaId)->get()
        ]);
    }
}
