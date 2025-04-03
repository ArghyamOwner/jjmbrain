<?php

namespace App\Http\Livewire\Contractors;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Card extends Component
{
    public function render()
    {
        return view('livewire.contractors.card', [
            'counts' => DB::table('contractor_details')
                ->selectRaw("count(*) as allCount")
                ->selectRaw("count(case when contractor_type = 'I' then 1 end) as class1")
                ->selectRaw("count(case when contractor_type = 'II' then 1 end) as class2")
                ->selectRaw("count(case when contractor_type = 'III' then 1 end) as class3")
                ->first(),
        ]);
    }
}
