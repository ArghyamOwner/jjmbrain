<?php

namespace App\Http\Livewire\JalMitra;

use App\Models\District;
use App\Models\Division;
use App\Models\Scheme;
use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Users extends Component
{
    use WithPagination;

    public $search;
    public $division = 'all';
    public $district = 'all';
    public $hasScheme = 'all';
    public $status = 'all';

    protected $queryString = [
        'search' => ['except' => ''],
        'division' => ['except' => 'all'],
        'district' => ['except' => 'all'],
        'hasScheme' => ['except' => 'all'],
        'status' => ['except' => 'all'],
    ];

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function resetFilter()
    {
        $this->reset(['search', 'division', 'district', 'hasScheme', 'status']);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function getDivisionsProperty()
    {
        return Division::query()->pluck('name', 'id');
    }

    public function getDistrictsProperty()
    {
        return District::query()->pluck('name', 'id');
    }

    public function render()
    {
        $user = auth()->user();

        $jms = [];
        if ($user->isPanchayat()) {
            $jms = Scheme::query()
                ->whereHas('panchayats', function ($subQuery) use ($user) {
                    $subQuery->where('panchayats.id', $user->panchayat_id);
                })
                ->whereNotNull('user_id')
                ->pluck('user_id')->all();
        }
        if ($user->isCeoZp()) {
            $jms = Scheme::query()
                ->whereIn('district_id', $user->districts()->pluck('district_id'))
                ->whereNotNull('user_id')
                ->pluck('user_id')->all();
        }
        if ($user->isBlockUser()) {
            $jms = Scheme::query()
                ->whereHas('blocks', function ($subQuery) {
                    $subQuery->where('blocks.id', auth()->user()->blocks()->pluck('block_id'));
                })
                ->whereNotNull('user_id')
                ->pluck('user_id')->all();
        }

        $showEditButton = false;
        if ($user->isAdministrator() || $user->isCallCenter()) {
            $showEditButton = true;
        }

        $users = User::query()
            ->with(['divisions', 'districts', 'scheme'])
            ->when($this->search != '', fn($query) => $query->whereLike(['name', 'email', 'phone'], $this->search))
            ->when($this->division != 'all', fn($query) => $query->whereRelation('divisions', 'division_id', $this->division))
            ->when($this->district != 'all', fn($query) => $query->whereRelation('districts', 'district_id', $this->district))
            ->when($this->hasScheme == 'yes', fn($query) => $query->whereHas('scheme'))
            ->when($this->hasScheme == 'no', fn($query) => $query->doesntHave('scheme'))
            ->when($this->status == 'active', fn($query) => $query->whereNull('blocked_at'))
            ->when($this->status == 'blocked', fn($query) => $query->whereNotNull('blocked_at'))
            ->when($user->isPanchayat() || $user->isCeoZp() || $user->isBlockUser(), function ($query) use ($jms) {
                $query->whereIn('id', $jms);
            })
            ->where('role', 'jal-mitra')
            ->latest('id');

        return view('livewire.jal-mitra.users', [
            'totalJm' => $users->count(),
            // 'totalJm' => User::where('role', 'jal-mitra')
            //     ->when($user->isPanchayat() || $user->isCeoZp() || $user->isBlockUser(), function ($query) use ($jms) {
            //         $query->whereIn('id', $jms);
            //     })->count(),
            'showEditButton' => $showEditButton,
            'users' => $users->fastPaginate(),
        ]);
    }
}
