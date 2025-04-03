<?php

namespace App\Http\Livewire\Members;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.members.index', [
            'members' => Member::query()
                ->with('district')
                ->when(!auth()->user()->isAdministratorOrStateJaldootCell(), function ($query) {
                    $query->whereIn('district_id', auth()->user()->districts()->pluck('district_id'));
                })
                ->latest('id')
                ->fastPaginate(),
        ]);
    }
}
