<?php

namespace App\Http\Livewire\Campaigns;

use App\Models\Campaign;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.campaigns.index', [
            'campaigns' => Campaign::query()
                ->latest('id')
                ->fastPaginate(10),
        ]);
    }
}
