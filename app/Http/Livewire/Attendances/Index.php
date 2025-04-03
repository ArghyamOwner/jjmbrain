<?php

namespace App\Http\Livewire\Attendances;

use App\Models\Classes;
use App\Models\Student;
use Livewire\Component;
use Carbon\CarbonImmutable;
use App\Models\AcademicYear;

class Index extends Component
{
    public $year;
    public $month;
    public $grade;
    public $search;

    protected $queryString = [
        'search' => ['except' => ''],
        'month' => ['except' => ''],
        'grade' => ['except' => '']
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function resetFilter()
    {
        $this->reset(['search']);
    }

    public function mount()
    {
        $this->year = date('Y');
        $this->month = date('m');
        // $this->grade = 1;
    }

    public function getAcademicYearProperty()
    {
        return AcademicYear::whereNotNull('activated_at')->first();
    }

    public function getClassesProperty()
    {
        return Classes::pluck('class_grade', 'id');
    }

    public function getMonthsProperty()
    {
        return [
            'year' => $this->year,
            'dates' => collect(CarbonImmutable::create($this->year, $this->month)->startOfMonth()->toPeriod(CarbonImmutable::create($this->year, $this->month)->endOfMonth())->toArray())
                ->map(fn ($date) => [
                    'formatted' => $date->format('Y-m-d'),
                    'date' => $date->format('d'),
                    'shortMonth' => $date->format('M'),
                    'day' => $date->format('D'),
                ]),
            'months' => collect(range(1, 12))
                ->flatMap(fn ($month) => [
                    CarbonImmutable::create($this->year, $month, 1)->format('m') => CarbonImmutable::create($this->year, $month, 1)->format('F Y')
                ])->all(),
        ];
    }

    public function render()
    {
        $startDate = CarbonImmutable::create($this->year, $this->month)->startOfMonth();
        $endDate = CarbonImmutable::create($this->year, $this->month)->endOfMonth();

        $students = Student::with(['user', 'attendances.student.user'])
            ->whereHas(
                'attendances',  
                fn ($query) => $query->whereBetween('date', [$startDate, $endDate])
                    ->where('academic_year_id', $this->academicYear->id)
                    ->where('school_id', auth()->user()->school_id)
            )
            // ->where('grade', $this->grade) // replace with class_id by upgrading the table field
            ->where('class_id', $this->grade) // replace with class_id by upgrading the table field
            ->when($this->search != '', fn($q) => $q->whereLike('user.name', $this->search))
            ->get();
            
        return view('livewire.attendances.index', [
           'students' => $students,
           'monthDates' => range($startDate->format('d'), $endDate->format('d'))
        ]);
    }

    // $attendances = Attendance::query()
    //         ->with('student.user')
    //         ->withWhereHas('student', function ($query) {
    //             // $query->where('class_id', $classId);
    //             return $query->where('grade', 1);
    //         })
    //         ->whereBetween('date', [$startDate, $endDate])
    //         ->orderBy('date')
    //         ->get()
    //         ->groupBy(function ($attendance) {
    //             return $attendance->student->user->name;
    //         });

    // $attendances = Attendance::query()
    //         ->join('students', 'attendances.student_id', '=', 'students.id')
    //         ->join('users', 'students.id', '=', 'users.userable_id')
    //         ->select(
    //             'students.id', 
    //             'students.grade', 
    //             'users.name', 
    //             'students.photo',
    //             'attendances.date', 
    //             'attendances.status'
    //         )
    //         // ->with('student.user')
    //         // ->withWhereHas('student', function ($query) {
    //         //     // $query->where('class_id', $classId);
    //         //     return $query->where('grade', 1);
    //         // })
    //         ->where('students.grade', 1)
    //         ->whereBetween('date', [$startDate, $endDate])
    //         ->orderBy('date')
    //         ->get()
    //         ->groupBy('name');
}
