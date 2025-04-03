<?php

namespace App\Http\Livewire\Notices;

use App\Models\Notice;
use Livewire\Component;

class LatestFive extends Component
{
    public function render()
    {
        return view('livewire.notices.latest-five', [
            'notices' => Notice::query()
                ->when(!auth()->user()->isAdministrator(), fn ($query) => $query->where('role', auth()->user()->role))
                ->latest('id')
                ->limit(5)
                ->get()
        ]);
    }
}
