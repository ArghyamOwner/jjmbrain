<?php

namespace App\Http\Livewire\Students;

use Carbon\Carbon;
use App\Models\Student;
use Livewire\Component;
use App\Models\Attendance;
use Carbon\CarbonImmutable;
use App\Models\AcademicYear;

class Attendances extends Component
{
    public $studentId;
    public $studentName;
    public $year;
    public $month;
    
    public function mount(Student $student)
    {
        $student->load('user');

        $this->studentId = $student->id;
        $this->studentName = $student->user->name;
        $this->year = date('Y');
        $this->month = date('m');
    }

    public function getCalendarProperty()
    {
        $selectedDate = CarbonImmutable::create($this->year, $this->month);
        $startOfMonth = $selectedDate->startOfMonth();
        $endOfMonth = $selectedDate->endOfMonth();
        $startOfWeek = $startOfMonth->startOfWeek(Carbon::SUNDAY);
        $endOfWeek = $endOfMonth->endOfWeek(Carbon::SATURDAY);

        return [
            'year' => $this->year,
            'weeks' => collect(
                    $startOfWeek->toPeriod($endOfWeek)->toArray()
                )->map(fn ($date) => [
                    'formatted' => $date->format('Y-m-d'),
                    'date' => $date->format('d'),
                    'shortMonth' => $date->format('M'),
                    'shortDay' => $date->format('D'),
                    'day' => $date->day,
                    'withinMonth' => $date->between($startOfMonth, $endOfMonth),
                ])->chunk(7),
            'months' => collect(range(1, 12))
                ->flatMap(fn ($month) => [
                    CarbonImmutable::create($this->year, $month, 1)->format('m') => CarbonImmutable::create($this->year, $month, 1)->format('F Y')
                ])->all(),
        ];
    }

    public function getAcademicYearProperty()
    {
        return AcademicYear::whereNotNull('activated_at')->first();
    }

    public function render()
    {
        $startDate = CarbonImmutable::create($this->year, $this->month)->startOfMonth();
        $endDate = CarbonImmutable::create($this->year, $this->month)->endOfMonth();
        
        return view('livewire.students.attendances', [
            'attendances' => Attendance::query()
                ->whereBetween('date', [$startDate, $endDate])
                ->where('academic_year_id', $this->academicYear->id)
                ->where('student_id', $this->studentId)
                ->get()
        ]);
    }
}
