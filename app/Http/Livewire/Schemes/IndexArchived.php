<?php

namespace App\Http\Livewire\Schemes;

use App\Enums\SchemeOperatingStatus;
use App\Enums\SchemeWorkStatus;
use App\Models\Block;
use App\Models\District;
use App\Models\Division;
use App\Models\Scheme;
use App\Scopes\NonArchivedSchemesScope;
use Livewire\Component;
use Livewire\WithPagination;

class IndexArchived extends Component
{
    use WithPagination;

    public $search;
    public $status = 'all';
    public $division = 'all';
    public $district = 'all';
    public $block = 'all';
    public $panchayat = 'all';
    public $operating_status = 'all';
    public $has_litholog = '';
    public $hasConsumerNo = '';
    public $hasLocation = '';
    public $hasLac = '';
    public $hasWuc = '';
    public $without_sdo_approval = '';
    public $showType = '';
    public $districts = [];
    public $blocks = [];
    public $panchayats = [];

    protected $queryString = [
        'search' => ['except' => ''],
        'status' => ['except' => 'all'],
        'division' => ['except' => 'all'],
        'district' => ['except' => 'all'],
        'block' => ['except' => 'all'],
        'panchayat' => ['except' => 'all'],
        'operating_status' => ['except' => 'all'],
        'has_litholog' => ['except' => ''],
        'hasConsumerNo' => ['except' => ''],
        'hasLocation' => ['except' => ''],
        'without_sdo_approval' => ['except' => ''],
        'showType' => ['except' => ''],
        'hasLac' => ['except' => ''],
        'hasWuc' => ['except' => ''],
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

    // public function getDistrictsProperty()
    // {
    //     return District::orderBy('name')->pluck('name', 'id');

    //     // auth()->user()->divisions->flatMap(fn($item) =>
    //     //     $item->districts->map(fn($district) => [
    //     //         $district->id => $district->name,
    //     //     ])
    //     // );
    // }

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
        return view('livewire.schemes.index-archived', [
            'schemes' => Scheme::query()
                ->withoutGlobalScopes([
                    NonArchivedSchemesScope::class,
                ])
                ->where('is_archived', Scheme::ARCHIVED)
                ->withCount('beneficiaries')
                ->with(['division', 'district', 'blocks', 'user', 'schemePanchayatVerification:id,scheme_id'])
                ->withExists(['lithologs'])
            // ->when(($user->isExecutiveEngineer() || $user->isTpaAdmin() || $user->isSdo()),
            //     fn($query) => $query->whereIn('division_id', $user->divisions()->pluck('division_id')))
            // ->when($user->isSectionOfficer(), function ($query) {
            //     $query->whereHas('users', function ($subQuery) {
            //         $subQuery->where('users.id', Auth::id());
            //     });
            // })
            // ->when($user->isBlockUser(), function ($query) {
            //     $query->whereHas('blocks', function ($subQuery) {
            //         $subQuery->where('blocks.id', auth()->user()->blocks()->pluck('block_id'));
            //     });
            // })
            // ->when($user->isPanchayat(), function ($query) {
            //     $query->whereHas('panchayats', function ($subQuery) {
            //         $subQuery->where('panchayats.id', auth()->user()->panchayat_id);
            //     });
            // })
                ->when(($user->isDc()),
                    fn($query) => $query->whereIn('district_id', $user->districts()->pluck('district_id')))
                ->when($this->search != '', fn($query) => $query->whereLike(['name', 'imis_id', 'old_scheme_id'], $this->search))
                ->when($this->status != 'all', fn($query) => $query->where('work_status', $this->status))
                ->when($this->operating_status != 'all', fn($query) => $query->where('operating_status', $this->operating_status))
                ->when($this->division != 'all', fn($query) => $query->where('division_id', $this->division))
                ->when($this->district != 'all', fn($query) => $query->where('district_id', $this->district))
                ->when($this->block != 'all', fn($query) => $query->whereHas('blocks', function ($query) {
                    $query->where('block_id', $this->block);
                }))
            // ->when($this->panchayat != 'all', fn($query) => $query->whereHas('panchayats', function ($query) {
            //     $query->where('panchayat_id', $this->panchayat);
            // }))
                ->when($this->has_litholog == 'yes', fn($query) => $query->whereHas('lithologs'))
                ->when($this->has_litholog == 'no', fn($query) => $query->doesntHave('lithologs'))
                ->when($this->hasWuc != '', fn($query) => $query->whereHas('wucs'))
                ->when($this->hasConsumerNo != '', fn($query) => $query->whereNotNull('consumer_no'))
                ->when($this->hasLocation != '', fn($query) => $query->whereNotNull(['latitude', 'longitude']))
                ->when($this->hasLac != '', fn($query) => $query->whereNotNull('lac_id'))
                ->when($this->without_sdo_approval != '', fn($query) => $query->whereHas('lithologs', fn($q) => $q->whereNull('verification_status')))
                ->when($this->showType == 'child', fn($query) => $query->whereNotNull('parent_id'))
                ->when($this->showType == 'parent', fn($query) => $query->whereNull('parent_id'))
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
