<?php

namespace App\Http\Livewire\WucMembers;

use App\Models\WucMember;
use Livewire\Component;

class Index extends Component
{
    public $wuc;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.wuc-members.index',[
            'members' => WucMember::query()
                ->with('user:id,blocked_at')
                ->where('wuc_id', $this->wuc)
                ->get()
        ]);
    }
}
