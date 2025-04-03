<?php

namespace App\Http\Livewire\Schools;

use App\Models\Block;
use App\Models\School;
use Livewire\Component;
use App\Models\District;
use Illuminate\Support\Str;
use App\Enums\SchoolCategory;
use App\Enums\AffiliatedBoards;
use Illuminate\Validation\Rule;
use App\Enums\SchoolOperationType;
use App\Enums\SchoolManagementType;
use App\Models\Classes;
use App\Traits\InteractsWithBanner;

class Create extends Component
{
    use InteractsWithBanner;

    public $name;
    public $board;
    public $category;
    public $managementType;
    public $schoolType = 'rural';
    public $schoolOperationType = 'self-funded';
    public $clusterNo;
    public $uin_code;

    public $district;
    public $block;
    public $website;
    public $phone;
    public $email;
    public $streetAddress;
    public $village;
    public $city;
    public $postalCode;

    public $totalLandArea;
    public $studentCapacity;
    public $totalToilets;
    public $functionalToilets;
    
    public $blocks = [];

    public function save()
    {
        $validated = $this->validate([
            'name' => ['required'],
            // 'board' => ['required', Rule::in(AffiliatedBoards::values())],
            'category' => ['required', Rule::in(SchoolCategory::values())],
            'managementType' => ['required', Rule::in(SchoolManagementType::values())],
            'schoolType' => ['required', Rule::in(['rural', 'urban'])],
            'schoolOperationType' => ['required', Rule::in(SchoolOperationType::values())],
            'clusterNo' => ['nullable'],
            'uin_code' => ['required', Rule::unique('schools', 'uin_code')],

            'district' => ['required'],
            'block' => ['required'],
            'website' => ['required'],
            'phone' => ['required'],
            'email' => ['required'],
            'streetAddress' => ['required'],
            'village' => ['required'],
            'city' => ['required'],
            'postalCode' => ['required', 'digits:6'],

            'totalLandArea' => ['required'],
            'studentCapacity' => ['required'],
            'totalToilets' => ['required'],
            'functionalToilets' => ['required'],
        ]);

        School::create([
            'district_id' => $validated['district'],
            'block_id' => $validated['block'],
            'name' => $validated['name'],
            
            'cluster_code' => $validated['clusterNo'],
            'operation_type' => $validated['schoolOperationType'],
            'school_geographic_area' => $validated['schoolType'],
            'affiliated_board' => 'APSB',
            'management_type' => $validated['managementType'], 
            'school_category' => $validated['category'],

            'uin_code' => $validated['uin_code'],
            'website' => $validated['website'],
            'phone' => $validated['phone'],
            'email' => $validated['email'],
            'street_address' => $validated['streetAddress'],
            'city' => $validated['city'],
            'village' => $validated['village'],
            'state' => 'Arunachal Pradesh',
            'postal_code' => $validated['postalCode'],
            'total_land_area' => $validated['totalLandArea'],
            'student_capacity' => $validated['studentCapacity'],
            'total_toilets' => $validated['totalToilets'],
            'total_functional_toilets' => $validated['functionalToilets'],
        ]);

        $this->banner('New school added.');

        return redirect()->route('schools');
    }

    public function getAffiliatedBoardsProperty()
    {
        return AffiliatedBoards::cases();
    }

    public function getSchoolCategoriesProperty()
    {
        return SchoolCategory::cases();
    }

    public function getClassesProperty()
    {
        return Classes::pluck('class_grade', 'id');
    }

    public function getSchoolManagementTypesProperty()
    {
        return SchoolManagementType::cases();
    }

    public function getDistrictsProperty()
    {
        return District::pluck('name', 'id');
    }

    public function render()
    {
        if ($this->district) {
            $this->blocks = Block::where('district_id', $this->district)->pluck('name', 'id');
        }

        return view('livewire.schools.create');
    }
}
