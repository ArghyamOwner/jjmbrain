<?php

namespace App\Http\Livewire\Teachers;

use App\Models\User;
use App\Enums\UserRole;
use Livewire\Component;
use App\Enums\EmploymentType;
use App\Enums\DesignationTypes;
use Illuminate\Validation\Rule;

class Index extends Component
{
    public $search;
    public $category = 'all';
    public $gender = 'all';
    
    protected $queryString = [
        'search' => ['except' => ''],
        'category' => ['except' => 'all'],
        'gender' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function render()
    {
        return view('livewire.teachers.index', [
            'teachers' => User::query()
                ->when($this->search != '', fn ($query) => $query->whereLike(['name'], $this->search))
                ->when($this->gender != 'all', fn ($query) => $query->where('gender', $this->gender))
                ->when($this->category != 'all', fn ($query) => $query->where('employment_type', $this->category))
                ->whereRole(UserRole::TEACHER->value)
                ->where('school_id', $this->user->school_id)
                ->orderBy('name')
                ->get()
        ]);
    }
}
