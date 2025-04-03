<?php

namespace App\Http\Livewire\Students;

use App\Models\Student;
use Livewire\Component;

class Show extends Component
{
    public $name;
    public $photo;
    public $gender;
    public $dob;
    public $phone;
    public $status;
    public $studentCode;
    public $grade;
    public $section;
    public $studentId;
    public $studentPhoto;
    public $schoolName;
    public $schoolBoard;
    public $statusColor;

    public function mount(Student $student)
    {
        $student->load(['user.school', 'class']);
 
        $this->schoolName = $student->user->school->name;
        $this->schoolBoard = $student->user->school->affiliated_board;
        $this->name = $student->user->name;
        $this->gender = $student->user->gender ?? 'male';
        $this->dob = $student->user->dob;
        $this->phone = $student->user->phone;
        $this->status = $student->status;
        $this->statusColor = $student->status_color;
        $this->studentCode = $student->student_code;
        $this->grade = $student?->class?->class_grade;
        $this->section = $student->section;
        $this->studentId = $student->id;
        $this->studentPhoto = $student->photo_url;
    }

    public function render()
    {
        return view('livewire.students.show');
    }
}
