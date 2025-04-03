<?php

namespace App\Http\Livewire\LithologDashboard;

use App\Models\Litholog;
use Livewire\Component;

class Cards extends Component
{
    public $stats = [];

    public function getStats()
    {
        $stats = Litholog::query()
            ->selectRaw("count(*) as lithologs")
            ->selectRaw("count(case when drilling_type = 'odex_rig' then 1 end) as oxed_litholog")
            ->selectRaw("count(case when drilling_type = 'reverse_rotary' then 1 end) as rev_rotary_litholog")
            ->selectRaw("count(case when drilling_type = 'rotary' then 1 end) as rotary_litholog")
            ->selectRaw("count(case when drilling_type = 'dth' then 1 end) as dth_litholog")
            ->selectRaw("count(case when drilling_type = 'hand_boring' then 1 end) as hand_boring_litholog")
            ->selectRaw("count(case when verification_status = 'Accept' then 1 end) as sdo_approved_litholog")
            ->first();

        $this->stats = [
            'Total Number of Lithologs' => $stats->lithologs,
            'Number of Lithologs with Odex-Rig' => $stats->oxed_litholog,
            'Lithologs with Reverse Rotary' => $stats->rev_rotary_litholog,
            'Lithologs with Rotary' => $stats->rotary_litholog,
            'Lithologs with DTH' => $stats->dth_litholog,
            'Lithologs with Hand Boring' => $stats->hand_boring_litholog,
            'Approved by SDO Lithologs' => $stats->sdo_approved_litholog,
            'Without Water Layer Lithologs' => Litholog::doesntHave('waterLevels')->count(),
        ];
    }

    public function render()
    {
        return view('livewire.litholog-dashboard.cards');
    }
}
