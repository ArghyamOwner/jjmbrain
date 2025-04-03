<?php

namespace App\Http\Livewire\Grievances;

use App\Models\User;
use App\Models\Block;
use App\Models\Issue;
use App\Models\Scheme;
use App\Models\Village;
use Livewire\Component;
use App\Models\Category;
use App\Models\District;
use App\Models\Division;
use App\Models\Grievance;
use App\Models\Panchayat;
use App\Enums\SchemeTypes;
use App\Models\Beneficiary;
use App\Models\SubCategory;
use App\Enums\SchemeWorkStatus;
use App\Models\IssueEscalation;
use Illuminate\Support\Facades\DB;
use App\Models\AssignGrievanceTask;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Log;
use App\Traits\WithUniqueRandomNumberGenerator;

class CreateInbound extends Component
{
    use InteractsWithBanner;
    use WithUniqueRandomNumberGenerator;

    //public $issueId;
    public $priority;
    public $description;
    public $divisionId;
    public $schemeId;
    public $beneficiaryId;

    public $schemes = [];
    public $beneficiaries = [];

    public $showHasSchemeFields = false;
    public $showHasBeneficiaryFields = false;
    public $showCitizenFields = false;

    public $hasIssue;
    public $hasBeneficiary;
    public $beneficiary = 'no';

    public $citizenName;
    public $citizenPhone;

    public $blocks = [];
    public $panchayats = [];
    public $villages = [];

    public $districtId;
    public $blockId;
    public $gramPanchayatId;
    public $villageId;

    public $categoryId;
    public $subCategories = [];
    public $subCategoryId;

    public function updatedHasIssue()
    {
        if ($this->hasIssue === 'scheme') {
            $this->showHasSchemeFields = true;
        } else {
            $this->showCitizenFields = true;
            $this->showHasSchemeFields = false;
        }
    }

    public function updatedHasBeneficiary()
    {
        if ($this->hasBeneficiary == 'no') {
            $this->showCitizenFields = true;
            $this->showHasBeneficiaryFields = false;
        } else {
            $this->showCitizenFields = false;
            $this->showHasBeneficiaryFields = true;
            $this->beneficiaries = Beneficiary::where('scheme_id', $this->schemeId)->pluck('beneficiary_name', 'id')->all();
        }
    }

    public function getDistrictsProperty()
    {
        return District::query()->orderBy('name')->pluck('name', 'id');
    }

    public function updatedDistrictId()
    {
        $this->blocks = Block::where('district_id', $this->districtId)->orderBy('name')->pluck('name', 'id');
    }

    public function updatedBlockId()
    {
        $this->panchayats = Panchayat::where('block_id', $this->blockId)->orderBy('panchayat_name')->pluck('panchayat_name', 'id');
    }

    public function updatedGramPanchayatId()
    {
        $this->villages = Village::where('panchayat_id', $this->gramPanchayatId)->orderBy('village_name')->pluck('village_name', 'id');
    }

    public function updatedVillageId()
    {
        $this->schemes = Scheme::whereRelation('village', 'village_id', $this->villageId)->pluck('name', 'id');
    }

    // public function getIssuesProperty()
    // {
    //     return Issue::orderBy('issue')->pluck('issue', 'id')->all();
    // }

    public function getCategoriesProperty()
    {
        return Category::pluck('name', 'id')->all();
    }

    public function updatedCategoryId($value)
    {
        $this->subCategories = SubCategory::where('category_id', $value)->pluck('name', 'id');
    }

    public function save()
    {
        $validatedData = $this->validate([
            //  'issueId' => ['required'],
            'priority' => ['required'],
            'description' => ['nullable'],
            'hasIssue' => ['required'],
            'divisionId' => ['required'],
            'districtId' => ['nullable', 'required_if:hasIssue,scheme'],
            'blockId' => ['nullable', 'required_if:hasIssue,scheme'],
            'gramPanchayatId' => ['nullable', 'required_if:hasIssue,scheme'],
            'villageId' => ['nullable', 'required_if:hasIssue,scheme'],
            'schemeId' => ['nullable', 'required_if:hasIssue,scheme'],
            'hasBeneficiary' => ['nullable'],
            'beneficiaryId' => ['nullable', 'required_if:hasBeneficiary,yes'],
            'citizenName' => ['nullable'],
            'citizenPhone' => ['nullable', 'digits:10'],
            'categoryId' => ['nullable', 'required_if:hasIssue,scheme'],
            'subCategoryId' => ['nullable', 'required_if:hasIssue,scheme']
        ], [], [
            //  'issueId' => 'issue',
            'hasIssue' => 'issue releated',
            'divisionId' => 'division',
            'districtId' => 'district',
            'blockId' => 'block',
            'gramPanchayatId' => 'gaon Panchayat',
            'villageId' => 'village',
            'schemeId' => 'scheme',
            'categoryId' => 'category',
            'subCategoryId' => 'sub category'
        ]);

        try {
            DB::transaction(function () use ($validatedData) {

                $grievance =  Grievance::create([
                    'division_id' => $validatedData['divisionId'],
                    'scheme_id' => $validatedData['schemeId'],
                    'district_id' => $validatedData['districtId'],
                    'block_id' => $validatedData['blockId'],
                    'panchayat_id' => $validatedData['gramPanchayatId'],
                    'village_id' => $validatedData['villageId'],
                    'beneficiary_id' => $validatedData['beneficiaryId'],
                    'citizen_name' => $validatedData['citizenName'],
                    'citizen_phone' => $validatedData['citizenPhone'],
                    // 'issue_id' => $validatedData['issueId'],
                    'category_id' => $validatedData['categoryId'],
                    'sub_category_id' => $validatedData['subCategoryId'],
                    'priority' => $validatedData['priority'],
                    'description' => $validatedData['description'],
                    'reference_no' => $this->generateUniqueRandomNumber(),
                    'type' => Grievance::TYPE_INBOUND,
                    'platform' => Grievance::PLATFORM_CALL,
                    'raised_by_category' => Grievance::RAISEDBY_CALL_CENTRE,
                    'created_by' => auth()->id(),
                ]);

                $divisionUser = User::whereRelation('divisions', 'division_id', $validatedData['divisionId']);

                $dueDate = \Carbon\Carbon::now()->addDay(7)->format('Y-m-d');

                if($this->schemeWorkStatus) {
                    
                    if ($this->schemeWorkStatus === SchemeWorkStatus::HANDED_OVER) {

                        $user = $divisionUser->where('role', 'jal-mitra')->first();
    
                        if ($user) {
                            AssignGrievanceTask::create([
                                'role' => 'jal-mitra',
                                'assigned_to' => $user->id,
                                'due_date' => $dueDate,
                                'grievance_id' => $grievance->id,
                            ]);
                        } else {
    
                            $user =  $divisionUser->where('role', 'section-officer')->first();
    
                            AssignGrievanceTask::create([
                                'role' => 'section-officer',
                                'assigned_to' => $user->id,
                                'due_date' => $dueDate,
                                'grievance_id' => $grievance->id,
                            ]);
                        }
                    } else {
    
                        $user =  $divisionUser->where('role', 'section-officer')->first();
    
                        if ($user) {
                            AssignGrievanceTask::create([
                                'role' => 'section-officer',
                                'assigned_to' => $user->id,
                                'due_date' => $dueDate,
                                'grievance_id' => $grievance->id,
                            ]);
                        }
                    }
                }

                $this->banner('Grievance Created Successfully');
                return redirect()->route('grievanceDashboard');
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            $this->notify('Something went wrong');
        }
    }

    public function getSchemeWorkStatusProperty()
    {
        $result = Scheme::where('id', $this->schemeId)
            ->first();

        if ($result) {
            return $result->work_status;
        }

        // return Scheme::whereId($this->schemeId)->first()['work_status'];
    }

    public function render()
    {
        return view('livewire.grievances.create-inbound', [
            'priorityOptions' => Grievance::gePriorityOptions(),
            'divisions' => Division::orderBy('name')->pluck('name', 'id')->all(),
        ]);
    }
}
