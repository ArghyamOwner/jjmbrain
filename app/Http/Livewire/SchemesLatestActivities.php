<?php

namespace App\Http\Livewire;

use App\Models\SchemeActivity;
use Livewire\Component;

class SchemesLatestActivities extends Component
{
    public $activities;

    public function getActivities()
    {
        $user = auth()->user();
        $this->activities = SchemeActivity::query()
            ->with(['user:id,name', 'feedable', 'scheme:id,name,work_status'])
            ->when($user->isJalMitra(), fn($query) => $query->where('scheme_id', $user->scheme?->id))
            ->when($user->isSectionOfficer(), fn($query) => $query->whereIn('scheme_id', $user->schemes->pluck('id')))
            ->when(($user->isExecutiveEngineer() || $user->isSdo()), function ($q) use ($user) {
                $q->whereHas('scheme', fn($q) => $q->whereIn('division_id', $user->divisions->pluck('id')));
            })
            ->when(($user->isTechSupport()), function ($q) use ($user) {
                $q->whereRelation('user', 'role', 'tech-support');
            })
            ->latest('id')
            ->limit(10)
            ->get();
    }

    public function render()
    {
        return view('livewire.schemes-latest-activities');
    }
}
