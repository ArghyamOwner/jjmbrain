<?php

namespace App\Http\Livewire\Tenants\Members;

use App\Models\Member;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    
    public function render()
    {
        return view('livewire.tenants.members.index', [
            'members' => Member::latest('id')->fastPaginate()
        ]);
    }
}
