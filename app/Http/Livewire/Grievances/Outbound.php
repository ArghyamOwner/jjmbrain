<?php

namespace App\Http\Livewire\Grievances;

use App\Models\Beneficiary;
use App\Models\Campaign;
use App\Models\Division;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Outbound extends Component
{
    use WithPagination;

    public $search;
    // public $division = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        //  'division' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset(['search']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    // public function getDivisionsProperty()
    // {
    //     return Division::orderBy('name')->pluck('name', 'id');
    // }

    public function getCampaignProperty()
    {
        $campaign = Campaign::query()->where('status', Campaign::STATUS_ACTIVE)->first();

        if ($campaign) {
            return $campaign ?? null;
        }
    }

    public function render()
    {
        // $beneficiaries = Beneficiary::query()
        //     ->with('scheme.division', 'latestSurvey.calledBy')
        //     ->when($this->search != '', fn($query) => $query->whereLike(['beneficiary_name', 'beneficiary_phone', 'fhtc_number'], $this->search))
        //     ->when($this->division != 'all', fn($query) => $query->whereRelation('scheme.division', 'division_id', $this->division));

        $users = User::query()
            ->with('latestSurvey.calledBy')
            ->when($this->search != '', fn ($query) => $query->whereLike(['name', 'email'], $this->search))
            ->where('role', $this->campaign->role);

        return view('livewire.grievances.outbound', [
            // 'beneficiariesCount' => $beneficiaries->count(),
            // 'beneficiaries' => $beneficiaries
            //     ->latest('id')
            //     ->fastPaginate(),

            'usersCount' => $users->count(),
            'users' => $users
                ->orderBy('name')
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
