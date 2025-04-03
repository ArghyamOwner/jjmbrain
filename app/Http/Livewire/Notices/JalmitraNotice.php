<?php

namespace App\Http\Livewire\Notices;

use App\Models\Notice;
use Livewire\Component;
use Livewire\WithPagination;

class JalmitraNotice extends Component
{
    use WithPagination;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];
    
    public function render()
    {
        return view('livewire.notices.jalmitra-notice', [
            'notices' => Notice::query()
                ->with('user')
                ->where('role', 'jal-mitra')
                ->fastPaginate()
        ]);
    }
}
