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
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $photo;
    public $gender = 'male';
    public $dob;
    public $phone;
    public $status;
    public $student_code;
    public $grade;
    public $section = 'A';

    public function mount()
    {
        $this->status = StudentStatus::ATTENDING->value;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'photo' => ['required', 'image', 'max:2024'],
            'gender' => ['required', Rule::in(['male', 'female'])],
            'dob' => ['required', 'date:Y-m-d'],
            'phone' => ['nullable'],
            'student_code' => ['required', Rule::unique('students', 'student_code')],
            'status' => ['required', Rule::in(
                StudentStatus::values()
            )],
            'grade' => ['required'],
            'section' => ['required', Rule::in(['A', 'B', 'C', 'D', 'E'])],
        ]);

        try {
            DB::transaction(function () use ($validated) {
                
                $studentPhoto = $this->photo ? $this->photo->storePublicly('/', 'students') : null;

                $user = User::create([
                    'school_id' => $this->user->school_id,
                    'name' => $validated['name'],
                    'email' => $validated['phone'] . '@test.test',
                    'email_verified_at' => now(),
                    'password' => bcrypt('secret'),
                    'role' => UserRole::STUDENT,
                    'gender' => $validated['gender'],
                    'dob' => $validated['dob'],
                    'phone' => $validated['phone']
                ]);
        
                $student = Student::create([
                    'student_code' => $validated['student_code'],
                    // 'grade' => $validated['grade'],   
                    'class_id' => $validated['grade'],   
                    'section' => $validated['section'],
                    'status' => $validated['status'],
                    'photo' => $studentPhoto
                ]);
                
                // Needed for polymorphic relation userable()
                $student->user()->save($user);
            });

            $this->reset();
            $this->dispatchBrowserEvent('destroy-filepond');
            $this->bannerMessage('Student added.');
        } catch (\Exception $e) {
            $this->bannerMessage('Something went wrong. Try again.', 'danger');
        }
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
        return view('livewire.students.create');
    }
}
