<?php

namespace App\Http\Livewire\Profile;

use App\Models\SchemeActivity;
use Livewire\Component;

class Activities extends Component
{
    public function render()
    {
        return view('livewire.profile.activities', [
            'activities' => SchemeActivity::query()
            ->with(['user', 'feedable', 'scheme:id,name,work_status', 'contractorDetail'])
            ->whereBelongsTo(auth()->user(), 'user')
            ->latest('id')
            ->limit(50)
            ->get()
        ]);
    }
}
