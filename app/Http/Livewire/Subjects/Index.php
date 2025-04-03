<?php

namespace App\Http\Livewire\Subjects;

use App\Models\Classes;
use App\Models\Subject;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Validation\Rule;

class Index extends Component
{
    use WithPagination;

    public $subjectName;
    public $subjectCode;

    public $search;
  
    protected $queryString = [
        'search' => ['except' => ''],
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function save()
    {
        $validated = $this->validate([
            'subjectName' => ['required'],
            'subjectCode' => ['required', Rule::unique('subjects', 'subject_code')],
        ]);

        Subject::create([
            // 'school_id' => $this->user->school_id,
            'subject_name' => $validated['subjectName'],
            'subject_code' => $validated['subjectCode'],
        ]);

        $this->bannerMessage('Subject added.');
        
        $this->reset();

        $this->dispatchBrowserEvent('hide-modal');
    }

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function getClassesProperty()
    {
        return Classes::all();
    }
    
    public function render()
    {
        return view('livewire.subjects.index', [
            'subjects' => Subject::query()
                ->with('class')
                ->when($this->search != '', fn ($query) => $query->whereLike(['subject_name'], $this->search))
                // ->where('school_id', $this->user->school_id)
                ->latest('id')
                ->fastPaginate(10)
        ]);
    }
}
