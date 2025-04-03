<?php

namespace App\Http\Livewire\Schemes;

use App\Enums\SchemeOperatingStatus;
use App\Enums\SchemeWorkStatus;
use App\Models\Block;
use App\Models\District;
use App\Models\Division;
use App\Models\IOTDevice;
use App\Models\Scheme;
use App\Models\SchemeVendor;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class IOTUsers extends Component
{
    use WithPagination;

    public $search;
    public $status = 'all';
    public $division = 'all';
    public $district = 'all';
    public $block = 'all';
    public $panchayat = 'all';
    public $operating_status = 'all';
    public $tracking = 'all';
    public $pipeAttribute = 'all';
    public $workorders = 'all';
    public $woValueBelow10k = '';
    public $has_litholog = '';
    public $fhtc = '';
    public $hasConsumerNo = '';
    public $hasLocation = '';
    public $hasLac = '';
    public $hasWuc = '';
    public $without_sdo_approval = '';
    public $showType = '';
    public $location = '';
    public $imisIssue = '';
    public $tpiProgress = '';
    public $districts = [];
    public $blocks = [];
    public $panchayats = [];
    public $qrInstalled = 'all';
    public $without_subdivision = '';
    public $has_jm = '';

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
        'division' => ['except' => 'all'],
        'district' => ['except' => 'all'],
        'block' => ['except' => 'all'],
        'panchayat' => ['except' => 'all'],
        'operating_status' => ['except' => 'all'],
        'tracking' => ['except' => 'all'],
        'qrInstalled' => ['except' => 'all'],
        'workorders' => ['except' => 'all'],
        'pipeAttribute' => ['except' => 'all'],
        'has_litholog' => ['except' => ''],
        'hasConsumerNo' => ['except' => ''],
        'hasLocation' => ['except' => ''],
        'without_sdo_approval' => ['except' => ''],
        'showType' => ['except' => ''],
        'location' => ['except' => ''],
        'hasLac' => ['except' => ''],
        'hasWuc' => ['except' => ''],
        'woValueBelow10k' => ['except' => ''],
        'imisIssue' => ['except' => ''],
        'fhtc' => ['except' => ''],
        'tpiProgress' => ['except' => ''],
        'without_subdivision' => ['except' => ''],
        'has_jm' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset(['search',
            'division',
            'status',
            'operating_status',
            'has_litholog',
            'without_sdo_approval',
            'showType',
            'district',
            'block',
            'panchayat',
            'hasConsumerNo',
            'hasLocation',
            'hasLac',
            'hasWuc',
            'location',
            'tracking',
            'qrInstalled',
            'workorders',
            'woValueBelow10k',
            'imisIssue',
            'fhtc',
            'tpiProgress',
            'pipeAttribute',
            'without_subdivision',
            'has_jm',
        ]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getDivisionsProperty()
    {
        $user = auth()->user();
        return Division::query()
            ->when(($user->isExecutiveEngineer() || $user->isTpaAdmin() || $user->isSdo()),
                fn($query) => $query->whereIn('id', $user->divisions()->pluck('division_id')))
            ->orderBy('name')
            ->pluck('name', 'id');
    }

    public function updatedDivision()
    {
        if ($this->division) {
            $division = Division::find($this->division);
            if ($division) {
                $this->districts = $division->districts()->pluck('name', 'districts.id');
            } else {
                $this->districts = [];
            }
        } else {
            $this->districts = [];
        }
    }

    public function updatedDistrict()
    {
        if ($this->district) {
            $district = District::find($this->district);
            $this->blocks = $district?->blocks()?->pluck('name', 'blocks.id') ?? [];
        } else {
            $this->blocks = [];
        }
    }

    public function updatedBlock()
    {
        if ($this->block) {
            $block = Block::find($this->block);
            $this->panchayats = $block?->panchayats()?->pluck('panchayat_name', 'panchayats.id') ?? [];
        } else {
            $this->panchayats = [];
        }
    }

    public function getSchemeStatusesProperty()
    {
        return SchemeWorkStatus::cases();
    }

    public function getOperatingStatusesProperty()
    {
        return SchemeOperatingStatus::cases();
    }

    public function render()
    {
        $user = auth()->user();
        $showEditButton = true;
        if($user->isBlockUser() || $user->isPanchayat() || $user->isCeoZp() || $user->isPanchayatCommissioner()){
            $showEditButton = false;
        }
        // limited scheme infos
        $vendorScheme = SchemeVendor::query()->where('user_id',$user->id)
        ->with(['iotDevice','scheme:id,name,work_status,user_id,imis_id,old_scheme_id,division_id,district_id,operating_status','scheme.division', 'scheme.district', 'scheme.schemePanchayatVerification:id,scheme_id'])
        ->when($this->search != '', fn($query) => $query->whereLike(['scheme.imis_id', 'scheme.old_scheme_id', 'scheme.name'], $this->search))
        ->latest('id')
        ->fastPaginate(10);
        // dd(IOTDevice::all());
        // dd($vendorScheme[0]->iotDevice);
        return view('livewire.schemes.i-o-t-users', [
            'showEditButton' => $showEditButton,
            'iotSchemes' => $vendorScheme,
        ]);
    }
}
