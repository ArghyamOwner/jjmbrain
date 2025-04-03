<?php

namespace App\Http\Livewire\Classes;

use App\Models\Classes;
use App\Models\Subject;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Edit extends Component
{
    use InteractsWithBanner;

    public $classId;
    public $className;
    public $classGrade;
    public $subjects = [];

    protected $listeners = [
        'refreshData' => '$refresh'
    ];
 
    public function mount(Classes $classes)
    {
        $classes->load('subjects');

        $this->classId = $classes->id;
        $this->className = $classes->class_name;
        $this->classGrade = $classes->class_grade;

        $this->subjects = $classes->subjects->pluck('id');
    }

    public function save()
    {
        $validated = $this->validate([
            'className' => ['required']
        ]);

        $this->classes->update([
            'school_id' => $this->user->school_id,
            'class_name' => $validated['className']
        ]);

        $this->classes->refresh();

        $this->classId = $this->classes->id;

        $this->bannerMessage('Class updated');

        $this->emit('refreshData');
    }

    public function saveSubjects()
    {
        $validated = $this->validate([
            'subjects' => ['required', 'array'],
        ]);

        $this->classes->subjects()->sync($validated['subjects']);
        
        $this->classes->loadMissing('subjects');

        $this->subjects = $this->classes->subjects->pluck('id');

        $this->bannerMessage('Subjects updated');

        $this->emit('refreshData');
    }

    public function getClassesProperty()
    {
        return Classes::findOrFail($this->classId);
    }

    public function getUserProperty()
    {
        return auth()->user();
    }

    public function getAllClassesProperty()
    {
        return Classes::all();
    }

    public function getAllSubjectsProperty()
    {
        return Subject::query()
            // ->where('school_id', $this->user->school_id)
            ->get()
            ->map(fn($item) => [
                'label' => "$item->subject_name ($item->subject_code)",
                'value' => $item->id,
            ]);
    }

    public function render()
    {
        return view('livewire.classes.edit');
    }
}
