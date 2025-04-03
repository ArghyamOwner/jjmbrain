<?php

namespace App\Http\Livewire\Subjects;

use App\Models\Subject;
use Livewire\Component;
use App\Models\Milestone;
use App\Models\AcademicYear;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;

class Edit extends Component
{
    use InteractsWithBanner;

    public $subjectName;
    public $subjectCode;
    public $subjectId;
    public $milestoneTitle;

    protected $listeners = [
        'refreshData' => '$refresh'  
    ];

    public function mount()
    {
        $subject = $this->subject;

        $this->subjectId = $subject->id;
        $this->subjectName = $subject->subject_name;
        $this->subjectCode = $subject->subject_code;
    }

    public function getSubjectProperty()
    {
        return Subject::findOrFail($this->subjectId);
    }
 
    public function save()
    {
        $validated = $this->validate([
            'subjectName' => ['required'],
            'subjectCode' => ['required', Rule::unique('subjects', 'subject_code')],
        ]);

        $this->subject->update([
            'subject_code' => $validated['subjectCode'],
            'subject_name' => $validated['subjectName'],
        ]);

        $subject = $this->subject->refresh();
        $this->subjectId = $subject->id;
        $this->subjectName = $subject->subject_name;
        $this->subjectCode = $subject->subject_code;

        $this->bannerMessage('Subject updated.');

        $this->emit('$refresh');
    }

    public function render()
    {
        return view('livewire.subjects.edit');
    }
}
