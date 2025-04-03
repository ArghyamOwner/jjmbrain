<?php

namespace App\Http\Livewire\Schemes;

use App\Enums\SchemeOperatingStatus;
use App\Enums\SchemeWorkStatus;
use App\Models\Block;
use App\Models\District;
use App\Models\Division;
use App\Models\Scheme;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
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
    public $has_so = '';
    public $has_iot = '';
    public $fundingAgency = '';

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
        'has_so' => ['except' => ''],
        'has_iot' => ['except' => ''],
        'fundingAgency' => ['except' => ''],
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
            'has_so',
            'has_iot',
            'fundingAgency'
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
    public function filterData(){}

    public function render()
    {
        $user = auth()->user();
        $showEditButton = true;
        
        if($user->isBlockUser() || $user->isPanchayat() || $user->isCeoZp() || $user->isPanchayatCommissioner()){
            $showEditButton = false;
        }
        
        return view('livewire.schemes.index', [
            'showEditButton' => $showEditButton,
            'agencies' => config('freshman.funding_agencies'),
            'schemes' => Scheme::query()
            // ->withCount('beneficiaries')
            // ->with(['division', 'district', 'blocks', 'user', 'lithologs', 'schemePanchayatVerification:id,scheme_id']) // Optimized, removed litholog, user, blocks
                ->with(['division', 'district', 'schemePanchayatVerification:id,scheme_id'])
                ->when(($user->isExecutiveEngineer() || $user->isTpaAdmin() || $user->isSdo()),
                    fn($query) => $query->whereIn('division_id', $user->divisions()->pluck('division_id')))
                ->when($user->isSectionOfficer(), function ($query) {
                    $query->whereHas('users', function ($subQuery) {
                        $subQuery->where('users.id', Auth::id());
                    });
                })
                ->when(($user->isBlockUser() || $user->isAsrlmBlock()), function ($query) {
                    $query->parent()->whereHas('blocks', function ($subQuery) {
                        $subQuery->where('blocks.id', auth()->user()->blocks()->pluck('block_id'));
                    });
                })
                ->when($user->isPanchayat(), function ($query) {
                    $query->parent()->whereHas('panchayats', function ($subQuery) {
                        $subQuery->where('panchayats.id', auth()->user()->panchayat_id);
                    });
                })
                ->when($user->isPanchayatCommissioner(), function ($query) {
                    $query->parent();
                })
                ->when(($user->isCeoZp()),
                    fn($query) => $query->parent()->whereIn('district_id', $user->districts()->pluck('district_id')))
                ->when(($user->isDc()),
                    fn($query) => $query->whereIn('district_id', $user->districts()->pluck('district_id')))
            // ->when($this->search != '', fn($query) => $query->where('old_scheme_id', $this->search))
                ->when($this->search != '', fn($query) => $query->whereLike(['imis_id', 'old_scheme_id', 'name'], $this->search))
                ->when($this->status != 'all', fn($query) => $query->where('work_status', $this->status))
                ->when($this->operating_status != 'all', fn($query) => $query->where('operating_status', $this->operating_status))
                ->when($this->division != 'all', fn($query) => $query->where('division_id', $this->division))
                ->when($this->district != 'all', fn($query) => $query->where('district_id', $this->district))
                ->when($this->block != 'all', fn($query) => $query->whereHas('blocks', function ($query) {
                    $query->where('block_id', $this->block);
                }))
                ->when($this->panchayat != 'all', fn($query) => $query->whereHas('panchayats', function ($query) {
                    $query->where('panchayat_id', $this->panchayat);
                }))
                ->when($this->has_litholog == 'yes', fn($query) => $query->whereHas('lithologs'))
                ->when($this->has_litholog == 'no', fn($query) => $query->doesntHave('lithologs'))
                ->when($this->has_jm == 'yes', fn($query) => $query->whereNotNull('user_id'))
                ->when($this->has_jm == 'no', fn($query) => $query->whereNull('user_id'))
                ->when($this->has_so == 'yes', fn($query) => $query->whereHas('users'))
                ->when($this->has_so == 'no', fn($query) => $query->doesntHave('users'))
                ->when($this->has_iot == 'yes', fn($query) => $query->whereHas('schemeVendors'))
                ->when($this->has_iot == 'no', fn($query) => $query->doesntHave('schemeVendors'))
                ->when($this->hasWuc == 'yes', fn($query) => $query->whereHas('wucs'))
                ->when($this->hasWuc == 'no', fn($query) => $query->doesntHave('wucs'))
                ->when($this->hasWuc == 'multiple', fn($query) => $query->withCount('wucs')->having('wucs_count', '>', 1))
                ->when($this->hasConsumerNo != '', fn($query) => $query->whereNotNull('consumer_no'))
            // ->when($this->hasLocation != '', fn($query) => $query->whereNotNull(['latitude', 'longitude']))
                ->when($this->hasLac != '', fn($query) => $query->whereNotNull('lac_id'))
                ->when($this->without_sdo_approval != '', fn($query) => $query->whereHas('lithologs', fn($q) => $q->whereNull('verification_status')))
                ->when($this->showType == 'child', fn($query) => $query->whereNotNull('parent_id'))
                ->when($this->showType == 'parent', fn($query) => $query->whereNull('parent_id'))
                ->when($this->hasLocation == 'with', fn($query) => $query->whereNotNull(['latitude', 'longitude']))
                ->when($this->hasLocation == 'without', fn($query) => $query->whereNull(['latitude', 'longitude']))
                ->when($this->tracking == 'yes', function ($query) {$query->whereHas('canalTrackings', function ($subQuery) {$subQuery->whereNotNull('geojson');});})
                ->when($this->tracking == 'incomplete', function ($query) {$query->whereHas('canalTrackings', function ($subQuery) {$subQuery->whereNull('geojson');});})
                ->when($this->tracking == 'no', function ($query) {$query->doesntHave('canalTrackings');})
                ->when($this->qrInstalled == 'yes', fn($query) => $query->whereHas('schemeQrReports'))
                ->when($this->qrInstalled == 'no', fn($query) => $query->doesntHave('schemeQrReports'))
                ->when($this->workorders == 'yes', fn($query) => $query->whereHas('workorders'))
                ->when($this->workorders == 'no', fn($query) => $query->doesntHave('workorders'))
                ->when($this->tpiProgress == 'yes', fn($query) => $query->whereNotNull('tpi_progress'))
                ->when($this->tpiProgress == 'no', fn($query) => $query->whereNull('tpi_progress'))
                ->when($this->tpiProgress == 'upto_30', fn($query) => $query->where('tpi_progress', '<', 30))
                ->when($this->tpiProgress == 'upto_50', fn($query) => $query->whereBetween('tpi_progress', [30, 50]))
                ->when($this->tpiProgress == 'upto_80', fn($query) => $query->whereBetween('tpi_progress', [51, 80]))
                ->when($this->tpiProgress == 'upto_90', fn($query) => $query->whereBetween('tpi_progress', [81, 90]))
                ->when($this->tpiProgress == 'above_90', fn($query) => $query->where('tpi_progress', '>', 90))
                ->when($this->pipeAttribute == 'yes', fn($query) => $query->whereHas('canalTrackingPoints'))
                ->when($this->pipeAttribute == 'no', fn($query) => $query->doesntHave('canalTrackingPoints'))
                ->when($this->woValueBelow10k != '', fn($query) => $query->whereHas('workorders', function ($subQuery) {$subQuery->where('workorder_amount', '<', 100000);}))
                ->when($this->imisIssue == 'yes', function ($query) {
                    $query->where(function ($query) {
                        $query->whereNull('imis_id')
                            ->orWhereRaw('LENGTH(imis_id) <= 2')
                            ->orWhereColumn('imis_id', 'old_scheme_id');
                    });
                })
                ->when($this->fhtc == 'yes', fn($query) => $query->whereHas('beneficiaries'))
                ->when($this->fhtc == 'no', fn($query) => $query->doesntHave('beneficiaries'))
                ->when($this->without_subdivision == 'yes', fn($query) => $query->doesntHave('subdivisions'))
                ->when($this->without_subdivision == 'no', fn($query) => $query->whereHas('subdivisions'))
                ->when($this->fundingAgency, fn($query) => $query->where('funding_agency', $this->fundingAgency))
                ->latest('id')
                ->fastPaginate(10),
        ]);
    }
}
