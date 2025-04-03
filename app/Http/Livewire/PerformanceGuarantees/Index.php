<?php

namespace App\Http\Livewire\PerformanceGuarantees;

use App\Enums\PerformanceGuaranteeType;
use App\Models\Bank;
use App\Models\PerformanceGuarantee;
use App\Models\User;
use Livewire\Component;

class Index extends Component
{
    public $search;
    public $isExpired;
    public $expiringDay;
    public $isWithdrawn;
    public $contractor;
    public $status = 'all';
    public $type = 'all';
    public $bank = 'all';
    public $showAddEditButton = false;

    protected $queryString = [
        'search' => ['except' => ''],
        'expiringDay' => ['except' => ''],
        'contractor' => ['except' => ''],
        'isExpired' => ['except' => ''],
        'isWithdrawn' => ['except' => ''],
        'status' => ['except' => 'all'],
        'type' => ['except' => 'all'],
        'bank' => ['except' => 'all'],
    ];

    public function mount()
    {
        if (auth()->user()->isAdministratorOrSuper() || auth()->user()->isExecutiveEngineer() || auth()->user()->isAddChiefEngineer() || auth()->user()->isSuperintendentEngineer() || auth()->user()->isHeadOffice()) {
            $this->showAddEditButton = true;
        }
    }

    public function resetFilter()
    {
        $this->reset(['status', 'search', 'type', 'bank', 'isExpired', 'isWithdrawn', 'contractor', 'expiringDay']);
        $this->dispatchBrowserEvent('reset-virtual-select');
    }

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function getPerformanceGuaranteeTypesProperty()
    {
        return PerformanceGuaranteeType::cases();
    }

    public function getBanksProperty()
    {
        return Bank::pluck('name')->all();
    }

    public function getContractorUsersProperty()
    {
        // return User::query()
        //     ->select('id', 'name')
        //     ->where('role', 'contractor')
        //     ->get()
        //     ->map(fn($item) => [
        //         "label" => $item->name,
        //         "value" => $item->id,
        //     ])->all();

        return User::where('role', 'contractor')
            ->with('contractor:id,user_id,bid_no')
            ->orderBy('name')
            ->get()
            ->map(fn($item) => [
                "label" => $item->name . " (" . ($item->contractor?->bid_no ?? 'N/A') . ")",
                "value" => $item->id,
            ])->all();
    }

    public function render()
    {
        return view('livewire.performance-guarantees.index', [
            'expiringDays' => config('jjm.expiring_days'),
            'performanceGuarantees' => PerformanceGuarantee::query()
            // ->with(['circle', 'workorder'])
                ->with(['contractor:id,name,phone', 'contractor.contractor:id,user_id,bid_no'])
                ->withSum('workorders', 'workorder_amount')
                ->when($this->search != '', fn($query) => $query->whereLike(['pg_number'], $this->search))
                ->when($this->isWithdrawn != '', fn($query) => $query->whereNotNull('withdrawn_at'))
                ->when($this->isExpired != '', fn($query) => $query->whereDate('expired_date', '<=', date('Y-m-d')))
                ->when($this->status == 'withdrawn', fn($query) => $query->whereNotNull('withdrawn_at'))
                ->when($this->status == 'not-withdrawn', fn($query) => $query->whereNull('withdrawn_at'))
                ->when($this->type != 'all', fn($query) => $query->where('pg_type', $this->type))
                ->when($this->bank != 'all', fn($query) => $query->where('bank_name', $this->bank))
                ->when($this->contractor != '', fn($query) => $query->where('contractor_id', $this->contractor))
                ->when($this->expiringDay != '', fn($query) => $query->filterByExpiringWithin($this->expiringDay))
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
