<?php

namespace App\Http\Livewire\Students;

use App\Models\Classes;
use App\Models\Student;
use Livewire\Component;
use App\Enums\StudentStatus;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $class = 'all';
    public $section = 'all';
    public $status = 'all';
    public $gender = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'class' => ['except' => 'all'],
        'section' => ['except' => 'all'],
        'status' => ['except' => 'all'],
        'gender' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function resetFilter()
    {
        $this->reset(['search']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function getClassesProperty()
    {
        return Classes::pluck('class_grade');
    }

    public function getStudentStatusesProperty()
    {
        return collect(StudentStatus::cases())->map(fn($item) => [
            'label' => $item->name,
            'value' => $item->value,
        ]);
    }
    
    public function render()
    {
        return view('livewire.students.index', [
            'students' => Student::query()
                ->with([
                    'user',
                    'user.school',
                    'class'
                ])
                ->when($this->user->isTeacher() || $this->user->isSubAdministrator() || $this->user->isPrincipal(), fn ($query) => $query->whereHas('user.school', function ($q) {
                    return $q->where('id', $this->user->school_id);
                }))
                ->when($this->search != '', fn ($query) => $query->whereLike(['user.name'], $this->search))
                ->when($this->class != 'all', fn ($query) => $query->where('grade', $this->class))
                ->when($this->section != 'all', fn ($query) => $query->where('section', $this->section))
                ->when($this->status != 'all', fn ($query) => $query->where('status', $this->status))
                ->when($this->gender != 'all', fn ($query) => $query->whereHas('user', fn ($q) => $q->where('gender', $this->gender)))
                ->latest('id')
                ->fastPaginate(10)
        ]);
    }
}
