<?php

namespace App\Http\Livewire\Schools;

use App\Models\School;
use Livewire\Component;
use App\Enums\SchoolCategory;
use App\Enums\AffiliatedBoards;
use Illuminate\Validation\Rule;
use App\Enums\SchoolOperationType;
use App\Enums\SchoolManagementType;

class Edit extends Component
{
    public $schoolId;
    public $name;
    public $board;
    public $category;
    public $managementType;
    public $schoolType = 'rural';
    public $schoolOperationType = 'self-funded';
    public $clusterNo;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function mount(School $school)
    {
        $this->schoolId = $school->id;
        $this->name = $school->name;
        $this->board = $school->affiliated_board;
        $this->category = $school->school_category;
        $this->managementType = $school->management_type;
        $this->schoolType = $school->school_geographic_area;
        $this->schoolOperationType = $school->operation_type;
        $this->clusterNo = $school->cluster_code;
    }

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            'board' => ['required', Rule::in(AffiliatedBoards::values())],
            'category' => ['required', Rule::in(SchoolCategory::values())],
            'managementType' => ['required', Rule::in(SchoolManagementType::values())],
            'schoolType' => ['required', Rule::in(['rural', 'urban'])],
            'schoolOperationType' => ['required', Rule::in(SchoolOperationType::values())],
            'clusterNo' => ['nullable']
        ]);

        $this->school->update([
            'name' => $validated['name'],
            'cluster_code' => $validated['clusterNo'],
            'operation_type' => $validated['schoolOperationType'],
            'school_geographic_area' => $validated['schoolType'],
            'affiliated_board' => $validated['board'],
            'management_type' => $validated['managementType'], 
            'school_category' => $validated['category'],
        ]);

        $this->notify('School details updated.');
    }

    public function getSchoolProperty()
    {
        return School::findOrFail($this->schoolId);
    }

    public function getAffiliatedBoardsProperty()
    {
        return AffiliatedBoards::cases();
    }

    public function getSchoolCategoriesProperty()
    {
        return SchoolCategory::cases();
    }

    public function getSchoolManagementTypesProperty()
    {
        return SchoolManagementType::cases();
    }

    public function render()
    {
        return view('livewire.schools.edit');
    }
}
