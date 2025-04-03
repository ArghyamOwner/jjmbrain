<?php

namespace App\Http\Livewire\Isa;

use App\Models\Isa;
use App\Models\Village;
use Livewire\Component;

class Stats extends Component
{
    public $stats = [];

    public function getStats()
    {
        $user = auth()->user();
        $stats = Isa::query()
        ->selectRaw("count(*) as isas")
        ->selectRaw("count(case when type = 'NGO' then 1 end) as ngoIsa")
        ->selectRaw("count(case when type = 'CLF' then 1 end) as clfIsa")
            ->when(!($user->isAdministrator() || $user->isStateIsa() || $user->isWucAuditor()), function ($q) use ($user) {
                if ($user->isAsrlmBlock()) {
                    $q->whereIn('block_id', $user->blocks->pluck('id'));
                } else {
                    $q->whereIn('district_id', $user->districts->pluck('id'));
                }
            })
            ->first();

        $this->stats = [
            // 'Number of schemes' => Str::money($totalPgAmount),
            'Total Number of ISA' => $stats->isas,
            'Total Number of NGO' => $stats->ngoIsa,
            'Total Number of CLF' => $stats->clfIsa,
            'Villages where ISA Not Assigned' => Village::query()
                ->when($user->isIsaCoordinator(), function ($q) use ($user) {
                        $q->whereIn('district_id', $user->districts->pluck('id'));
                })->doesntHave('isas')->count()
        ];
    }

    public function render()
    {
        return view('livewire.isa.stats');
    }
}
