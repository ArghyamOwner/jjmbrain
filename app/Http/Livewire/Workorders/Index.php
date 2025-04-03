<?php

namespace App\Http\Livewire\Workorders;

use App\Models\Division;
use App\Models\Scheme;
use App\Models\User;
use App\Models\Workorder;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search;
    public $issuingAuthority = '';
    public $contractor = 'all';
    public $SchemeApproved = 'all';

    public $dateRange;
    public $startDate;
    public $endDate;
    public $division_id;

    protected $queryString = [
        'search' => ['except' => ''],
        'issuingAuthority' => ['except' => ''],
        'dateRange' => ['except' => '', 'as' => 'date'],
        'contractor' => ['except' => 'all'],
        'SchemeApproved' => ['except' => 'all'],
        'division_id' => ['except' => ''],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'contractor', 'dateRange', 'SchemeApproved', 'division_id', 'issuingAuthority']);
        $this->resetPage();
        $this->dispatchBrowserEvent('reset-flatpicker');
        $this->dispatchBrowserEvent('reset-virtual-select');
    }

    public function getIssuingAuthoritiesProperty()
    {
        // if (auth()->user()->isAddChiefEngineer()) {
        //     $result = auth()->user()->offices()->orderBy('name')->pluck('name')->all();
        // } elseif (auth()->user()->isSuperintendentEngineer()) {
        //     $result = Zone::pluck('name')->all();
        // } elseif (auth()->user()->isExecutiveEngineer()) {
        //     $result = auth()->user()->divisions()->orderBy('name', 'asc')->pluck('name')->all();
        // } else {
        //     $offices = Circle::orderBy('name')->pluck('name')->all();
        //     $zones = array_merge($offices, collect(Zone::pluck('name'))->all());
        //     $div = array_merge($zones, collect(Division::orderBy('name', 'asc')->pluck('name'))->all());
        //     $result = array_merge(['Head Office'], $div);
        // }
        $result = Workorder::orderBy('issuing_authority')->pluck('issuing_authority')->unique()->values();
        return collect($result)->map(fn($item) => [
            "label" => $item,
            "value" => $item,
        ])->all();

        // $offices = Circle::orderBy('name')->pluck('name')->all();
        // $data = ['Head Office'] + collect(Zone::pluck('name'))->merge($offices)->all();

        // $result = $data + collect(Division::orderBy('name', 'asc')->pluck('name'))->all();

        // return collect($result)->filter(fn($item) =>
        //     $item !== "BTAD Circle" && $item !== "Dima Hasao Circle" && $item !== "KAAC Circle"
        // )->values()->all();
    }

    public function searchContractors($value)
    {
        $users = User::where('role', 'contractor')
            ->with('contractor:id,user_id,bid_no')
            ->where('name', 'like', '%' . $value . '%')
            ->get()
            ->map(fn($item) => [
                'label' => $item->name . ' (' . ($item->contractor?->bid_no ?? 'N/A') . ')',
                'value' => $item->id,
            ])->all();

        $this->emit('result-found-search-contractors', $users);
        // 3.0
        // $this->dispatch('result-found-search-contractors', $users);
    }
  

    public function search()
    {
        if ($this->dateRange) {
            $dates = explode('to', $this->dateRange);
            if (count($dates) > 1) {
                [$this->startDate, $this->endDate] = [trim($dates[0]), trim($dates[1])];
            } else {
                [$this->startDate, $this->endDate] = [$this->dateRange, $this->dateRange];
            }

            // dd($this->startDate.$this->endDate);
            // $this->startDate = trim($dates[0]);
            // $this->endDate = isset(trim($dates[1])) ? trim($dates[1]) : trim($dates[0]);
        }
    }

    public function getSchemeApprovesProperty()
    {
        return Scheme::query()->pluck('approved_on')->unique();
    }

    public function getDivisionsProperty()
    {
        return Division::orderBy('name')->pluck('name', 'id')->all();
    }

    public function render()
    {
        $user = auth()->user();
        return view('livewire.workorders.index', [
            'workorders' => Workorder::query()
                ->with(['circle', 'contractor.contractor:id,user_id,bid_no', 'schemes:id,name', 'division:id,name'])
                ->withExists('performanceGuarantees')
                ->when(($user->isExecutiveEngineer() || $user->isTpaAdmin() || $user->isSdo()),
                    fn($query) => $query->whereIn('division_id', $user->divisions()->pluck('division_id')))
                ->when($this->search != '', fn($query) => $query->whereLike(['workorder_number', 'workorder_name', 'issuing_authority', 'contractor.name'], $this->search))
                ->when($this->issuingAuthority != '', fn($query) => $query->where('issuing_authority', $this->issuingAuthority))
                ->when($this->contractor != 'all', fn($query) => $query->whereRelation('contractor', 'contractor_id', $this->contractor))
                ->when($this->SchemeApproved != 'all', fn($query) => $query->whereRelation('schemes', 'approved_on', $this->SchemeApproved))
                ->when($this->dateRange != '', fn($query) => $query->whereBetween('workorder_estimated_date', [$this->startDate, $this->endDate]))
                ->when($this->division_id != '', fn($query) => $query->where('division_id', $this->division_id))
                ->latest('id')
                ->fastPaginate(10),
            'withoutWoNumber' => Workorder::whereNull('workorder_number')
                ->when(($user->isExecutiveEngineer() || $user->isTpaAdmin() || $user->isSdo()),
                    fn($query) => $query->whereIn('division_id', $user->divisions()->pluck('division_id')))
                ->count(),
        ]);
    }
}
