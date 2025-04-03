<?php

namespace App\Http\Livewire\Issues;

use App\Models\Issue;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = [ 
        'refreshEditIssue' => '$refresh',
        'refreshData' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.issues.index', [
            'issues' => Issue::query()
                ->with('category', 'subCategory')
                ->latest('id')
                ->fastPaginate(10),
        ]);
    }
}
