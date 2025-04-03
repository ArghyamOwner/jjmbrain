<?php

namespace App\Http\Livewire\Changelogs;

use App\Models\Changelog;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.changelogs.index', [
            'changelogs' => Changelog::latest('id')->fastPaginate(10)
        ]);
    }
}
