<?php

namespace App\Http\Livewire\Students;

use App\Models\User;
use App\Enums\UserRole;
use App\Models\Classes;
use App\Models\Student;
use Livewire\Component;
use App\Enums\StudentStatus;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class Edit extends Component
{
    public $name;
    public $photo;
    public $gender;
    public $dob;
    public $phone;
    public $status;
    public $student_code;
    public $grade = 1;
    public $section = 'A';
    public $studentId;
    public $studentPhoto;

    public function mount(Student $student)
    {
        $student->load('user.school');
 
        $this->name = $student->user->name;
        $this->gender = $student->user->gender ?? 'male';
        $this->dob = $student->user->dob;
        $this->phone = $student->user->phone;
        $this->status = $student->status;
        $this->student_code = $student->student_code;
        $this->grade = $student->class_id;
        $this->section = $student->section;
        $this->studentId = $student->id;
        $this->studentPhoto = $student->photo_url;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'photo' => ['nullable', 'image', 'max:2048'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'dob' => ['required', 'date:Y-m-d'],
            'phone' => ['nullable'],
            'student_code' => ['required', Rule::unique('students', 'student_code')->ignore($this->studentId)],
            'status' => ['required', Rule::in(
                StudentStatus::values()
            )],
            'grade' => ['required'],
            'section' => ['required', Rule::in(['A', 'B', 'C', 'D', 'E'])],
        ]);
 
        try {
            DB::transaction(function () use ($validated) {
                $studentPhoto = $this->photo ? $this->photo->storePublicly('/', 'students') : null;

                $this->student->user()->update([
                    'name' => $validated['name'],
                    'phone' => $validated['phone'],
                    'gender' => $validated['gender'],
                    'dob' => $validated['dob'],
                ]);

                $this->student->update([
                    'student_code' => $validated['student_code'],
                    // 'grade' => $validated['grade'],   
                    'class_id' => $validated['grade'],   
                    'section' => $validated['section'],
                    'status' => $validated['status'],
                    'photo' => $studentPhoto
                ]);
            });

            $this->bannerMessage('Student updated.');
        } catch (\Exception $e) {
            $this->bannerMessage('Something went wrong. Try again.', 'danger');
        }
    }

    public function getStudentProperty()
    {
        return Student::findOrFail($this->studentId);
    }

    public function getClassesProperty()
    {
        return Classes::pluck('class_grade', 'id');
    }

    public function getStudentStatusesProperty()
    {
        return collect(StudentStatus::cases())->map(fn($item) => [
            'label' => $item->name,
            'value' => $item->value,
        ]);
    }

    public function getUserProperty()
    {
        return auth()->user();
    }
    
    public function render()
    {
        return view('livewire.students.edit');
    }
}
