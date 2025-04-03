<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\Jaldoot;
use Livewire\Component;
use App\Traits\WithSlideover;
use Illuminate\Validation\Rule;

class EditJalshalaSchoolsStudentSlideover extends Component
{
    use WithSlideover;

    public $student_name;
    public $student_phone;
    public $class;
    public $age;
    public $gender;
    public $jaldoot_uin;

    public $jaldootId;

    protected $listeners = [
        'openStudentEditSlideover' => 'openEditModal'
    ];

    public function openEditModal($id)
    {
        $this->resetErrorBag();

        $this->show = true;

        $jaldoot = Jaldoot::findOrFail($id);

        $this->jaldootId = $jaldoot->id;
        $this->student_name = $jaldoot->student_name;
        $this->student_phone = $jaldoot->student_phone;
        $this->class = $jaldoot->class;
        $this->age = $jaldoot->age;
        $this->gender = $jaldoot->gender;
        $this->jaldoot_uin = $jaldoot->jaldoot_uin;
    }

    public function save()
    {
        $validated = $this->validate([
            'student_name' => ['required'],
            'student_phone' => ['required', 'digits:10'],
            'class' => ['required', 'numeric', 'in:8,9,10,11,12'],
            'age' => ['required', 'numeric', 'in:10,11,12,13,14,15,16,17,18,19,20'],
            'gender' => ['required', 'in:male,female,others'],
            'jaldoot_uin' => ['required', Rule::unique('jaldoots')->ignore($this->jaldootId)]
        ]);

        $this->jaldoot->update($validated);

        $this->reset([
            'student_name',
            'student_phone',
            'class',
            'age',
            'gender',
            'jaldoot_uin'
        ]);

        $this->emit('refreshData');

        $this->notify('Student details updated.');

        $this->close();
    }

    public function getJaldootProperty()
    {
        return Jaldoot::findOrFail($this->jaldootId);
    }

    public function render()
    {
        return view('livewire.jalshalas.edit-jalshala-schools-student-slideover');
    }
}
