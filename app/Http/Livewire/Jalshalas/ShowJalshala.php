<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\School;
use Livewire\Component;
use App\Models\Jalshala;
use Illuminate\Support\Str;
use App\Models\JalshalaSchool;

class ShowJalshala extends Component
{
    public $jalshalaId;
    public $jalshala;
    public $educationBlockId;
    public $schoolId;
    public $teacher_name;
    public $phone_number;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(Jalshala $jalshala)
    {
        $jalshala->loadMissing([
            'user',
            'district',
            'block',
            'trainerOne',
            'trainerTwo',
            'schemes:id,name',
            'educationBlocks'
        ]);
        $this->jalshalaId = $jalshala->id;
        $this->jalshala = $jalshala;
        $this->educationBlockId = $jalshala->educationBlocks->pluck('id');
    }

    public function blockFormLink($formId)
    {
        $jalshalaSchool = JalshalaSchool::findOrFail($formId);

        if (is_null($jalshalaSchool->blocked_at)) {
            $jalshalaSchool->update([
                'blocked_at' => now()
            ]);
        } else {
            $jalshalaSchool->update([
                'blocked_at' => null
            ]);
        }

        $this->notify('Jal Shala Form blocked/un-blocked.');
    }

    public function getJalshalaProperty()
    {
        return Jalshala::findOrFail($this->jalshalaId);
    }

    public function addSchool()
    {
        $validated = $this->validate([
            'schoolId' => ['required'],
            'teacher_name' => ['required', 'string'],
            'phone_number' => ['required', 'digits:10'],
        ]);

        $validated['id'] = Str::uuid();

        $school = School::query()->whereId($validated['schoolId'])->first();

        $validated['school_name'] = $school->school_name;

        $validated['school_code'] = $school->school_code;

        
        JalshalaSchool::create([
            'school_name' => $validated['school_name'],
            'school_code' => $validated['school_code'],
            'teacher_name' => $validated['teacher_name'],
            'phone_number' => $validated['phone_number'],
            'jalshala_id' => $this->jalshalaId
        ]); 

        $this->reset(['teacher_name', 'phone_number']);

        $this->dispatchBrowserEvent('hide-modal');
    }

    public function getSchoolsProperty()
    {
        return School::query()->whereIn('education_block_id', $this->educationBlockId)
        ->where('category', '!=', '1 - Primary')
        ->get()
        ->map(fn ($item) => [
            "label" => $item->school_name,
            "value" => $item->id,
        ])->all();
    }

    public function render()
    {
        return view('livewire.jalshalas.show-jalshala', [
            'jalshalaSchools' => JalshalaSchool::query()
                ->withCount('jaldoots')
                ->where('jalshala_id', $this->jalshalaId)
                ->get()
        ]);
    }
}
