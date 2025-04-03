<?php

namespace App\Http\Livewire\PublicGrievances;

use App\Models\User;
use App\Models\Block;
use App\Models\Issue;
use App\Models\Scheme;
use App\Models\Village;
use Livewire\Component;
use App\Models\Category;
use App\Models\District;
use App\Models\Grievance;
use App\Models\Panchayat;
use App\Models\SubCategory;
use Livewire\WithFileUploads;
use App\Enums\SchemeWorkStatus;
use App\Services\OtpSmsService;
use Illuminate\Support\Facades\DB;
use App\Models\AssignGrievanceTask;
use App\Models\GrievanceImage;
use Illuminate\Support\Facades\Log;
use App\Traits\WithUniqueRandomNumberGenerator;
use Illuminate\Support\Facades\Lang;

class Create extends Component
{
    use WithFileUploads;
    use WithUniqueRandomNumberGenerator;

    public $districtId;
    public $blockId;
    public $gramPanchayatId;
    public $villageId;
    public $schemeId;
    public $blocks = [];
    public $panchayats = [];
    public $villages = [];
    public $schemes = [];
    //public $issueId;
    public $name;
    public $phone;
    public $images = [];
    public $description;

    public $otp;
    public $phoneIsVerified = false;
    public $otpSent = false;
    public $otpStatusMessage;

    public $lang = 'en';

    public $categoryId;
    public $subCategories = [];
    public $subCategoryId;

    public $sid;

    protected $queryString = [
        'lang' => [
            'except' => ''
        ],
        'sid' => [
            'except' => ''
        ]
    ];

    public function mount()
    {
        $scheme = Scheme::find($this->sid);

        $this->districtId = $scheme->district_id ?? '';

        if ($this->districtId) {
            $this->blocks = Block::where('district_id', $scheme->district_id)->orderBy('name')->pluck('name', 'id');
            $this->blockId = $scheme->block_id ?? '';
            $this->panchayats = Panchayat::where('block_id', $scheme->block_id)->orderBy('panchayat_name')->pluck('panchayat_name', 'id');
        }
    }

    public function verifyPhone()
    {
        $validated = $this->validate([
            'phone' => ['required', 'digits:10']
        ]);

        $response = OtpSmsService::make("6495363bd6fc057aeb47d6e2")
            ->to($validated['phone'])
            ->sendOtp();

        if ($response['type'] === 'success') {
            $this->otpStatusMessage = 'An OTP has been sent to your mobile';
            $this->otpSent = true;
        } else {
            $this->otpStatusMessage = 'Something went wrong. Try again.';
            $this->otpSent = false;
        }
    }

    public function verifyOtp()
    {
        $validated = $this->validate([
            'otp' => ['required', 'digits:6']
        ]);

        $response = OtpSmsService::make()
            ->to($this->phone)
            ->otp($validated['otp'])
            ->verifyOtp();

        $this->otpStatusMessage = '';

        if ($response['type'] === 'success') {
            $this->phoneIsVerified = true;
        } else {
            $this->phoneIsVerified = false;
        }
    }

    public function resendOtp()
    {
        $response = OtpSmsService::make("6495363bd6fc057aeb47d6e2")
            ->to($this->phone)
            ->resendOtp();

        if ($response['type'] === 'success') {
            $this->otpStatusMessage = 'An OTP has been re-sent to your mobile';
            $this->otpSent = true;
        } else {
            $this->otpStatusMessage = 'Something went wrong. Try again.';
            $this->otpSent = false;
        }
    }

    public function save()
    {
        $validatedData = $this->validate([
            'districtId' => ['required'],
            'blockId' => ['required'],
            'gramPanchayatId' => ['required'],
            'villageId' => ['required'],
            'schemeId' => ['required_if:sid,null'],
            //  'issueId' => ['required'],
            'name' => ['required', 'string'],
            'phone' => ['required', 'digits:10', 'required_if:phoneIsVerified,true'],
            'description' => ['nullable'],
            'images.*' => ['nullable', 'image', 'max:8000'],
            'categoryId' => ['required'],
            'subCategoryId' => ['required']

        ], [], [
            'districtId' => 'district',
            'blockId' => 'block',
            'gramPanchayatId' => 'Gaon Panchayat',
            'villageId' => 'village',
            'schemeId' => 'scheme',
            // 'issueId' => 'issue',
            'categoryId' => 'category',
            'subCategoryId' => 'sub category'
        ]);

        try {
            DB::transaction(function () use ($validatedData) {

                $grievance = Grievance::create([
                    'district_id' => $validatedData['districtId'],
                    'division_id' => $this->division,
                    'block_id' => $validatedData['blockId'],
                    'panchayat_id' => $validatedData['gramPanchayatId'],
                    'village_id' => $validatedData['villageId'],
                    'scheme_id' => $this->sid ?? $validatedData['schemeId'],
                    //  'issue_id' => $validatedData['issueId'],
                    'category_id' => $validatedData['categoryId'],
                    'sub_category_id' => $validatedData['subCategoryId'],
                    'citizen_name' => $validatedData['name'],
                    'citizen_phone' => $validatedData['phone'],
                    'description' => $validatedData['description'],
                    'reference_no' => $this->generateUniqueRandomNumber(),
                    'priority' => Grievance::PRIORITY_LOW,
                    'raised_by_category' => Grievance::RAISEDBY_CITIZEN,
                    'platform' => Grievance::PLATFORM_QR
                ]);

                if (isset($validatedData['images']) && count($validatedData['images']) > 0) {
                    foreach ($validatedData['images'] as $validatedImage) {
                        GrievanceImage::create([
                            'path' => $validatedImage->storePublicly('/', 'uploads'),
                            'extension' => $validatedImage->getClientOriginalExtension(),
                            'size' => $validatedImage->getSize(),
                            'grievance_id' => $grievance->id,
                        ]);
                    }
                }

                $dueDate = \Carbon\Carbon::now()->addDay(7)->format('Y-m-d');

                $divisionUser = User::whereRelation('divisions', 'division_id', $this->division)->exists();

                if ($divisionUser) {
                    if ($this->schemeWorkStatus === SchemeWorkStatus::HANDED_OVER) {

                        $user = User::whereRelation('divisions', 'division_id', $this->division)
                            ->where('role', 'jal-mitra')
                            ->whereHas('scheme', function ($q) use ($validatedData) {
                                $q->where('id', $this->sid)
                                    ->orWhere('id', $validatedData['schemeId']);
                            })->first();

                        if ($user) {
                            AssignGrievanceTask::create([
                                'role' => 'jal-mitra',
                                'assigned_to' => $user->id,
                                'due_date' => $dueDate,
                                'grievance_id' => $grievance->id,
                            ]);
                        } else {
                            $soUser =  User::whereRelation('divisions', 'division_id', $this->division)
                                ->where('role', 'section-officer')
                                ->whereHas('schemes', function ($q) use ($validatedData) {
                                    $q->where('schemes.id', $this->sid)
                                        ->orWhere('schemes.id', $validatedData['schemeId']);
                                })->first();

                            if ($soUser) {
                                AssignGrievanceTask::create([
                                    'role' => 'section-officer',
                                    'assigned_to' => $soUser->id,
                                    'due_date' => $dueDate,
                                    'grievance_id' => $grievance->id,
                                ]);
                            }
                        }
                    } else {
                        $sectionOfficer =  User::whereRelation('divisions', 'division_id', $this->division)
                            ->where('role', 'section-officer')
                            ->whereHas('schemes', function ($q) use ($validatedData) {
                                $q->where('schemes.id', $this->sid)
                                    ->orWhere('schemes.id', $validatedData['schemeId']);
                            })->first();

                        if ($sectionOfficer) {
                            AssignGrievanceTask::create([
                                'role' => 'section-officer',
                                'assigned_to' => $sectionOfficer->id,
                                'due_date' => $dueDate,
                                'grievance_id' => $grievance->id,
                            ]);
                        }
                    }
                }

                return redirect()->route('myapplications', $grievance->id);
            });
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            $this->notify('Something went wrong');
        }
    }

    public function getDistrictsProperty()
    {
        return District::query()->orderBy('name')->pluck('name', 'id');
    }

    public function updatedDistrictId($value)
    {
        $this->blocks = Block::where('district_id', $value)->orderBy('name')->pluck('name', 'id');
    }

    public function updatedBlockId($value)
    {
        $this->panchayats = Panchayat::where('block_id', $value)->orderBy('panchayat_name')->pluck('panchayat_name', 'id');
    }

    public function updatedgramPanchayatId($value)
    {
        $this->villages = Village::where('panchayat_id', $value)->orderBy('village_name')->pluck('village_name', 'id');
    }

    public function updatedVillageId($value)
    {
        $this->schemes = Scheme::whereRelation('village', 'village_id', $value)->pluck('name', 'id');
    }

    // public function getCategoriesProperty()
    // {
    //     return Category::orderBy('id')->pluck('name', 'id');
    // }

    public function updatedCategoryId($value)
    {
        $this->subCategories = SubCategory::where('category_id', $value)->get()
            ->map(function ($item) {
                app()->setLocale($this->lang);
                return [
                    'label' => Lang::get("{$item->name}"),
                    'value' => $item->id
                ];
            })
            ->all();
    }

    public function getDivisionProperty()
    {
        $result = Scheme::where('id', $this->schemeId)
            ->orWhere('id', $this->sid)
            ->first();

        if ($result) {
            return $result->division_id;
        }

        // return Scheme::where('id', $this->schemeId)->orWhere('id', $this->sid)->first()['division_id'];
    }

    public function getSchemeWorkStatusProperty()
    {
        $result = Scheme::where('id', $this->schemeId)
            ->orWhere('id', $this->sid)
            ->first();

        if ($result) {
            return $result->work_status;
        }

        // return Scheme::where('id', $this->schemeId)->orWhere('id', $this->sid)->first()['work_status'];
    }

    public function getCategoriesProperty()
    {
        return Category::all();
    }

    public function updatedLang($value)
    {
        $this->lang = $value;
    }

    public function render()
    {
        if (in_array($this->lang, ['en', 'hi', 'as', 'bn'])) {
            app()->setLocale($this->lang);
        } else {
            app()->setLocale('en');
        }

        return view('livewire.public-grievances.create')
            ->layout('layouts.guest');
    }
}
