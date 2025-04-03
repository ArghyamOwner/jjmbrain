<?php

namespace App\Http\Livewire\Classes;

use App\Models\Classes;
use Livewire\Component;

class Index extends Component
{
    public function getUserProperty()
    {
        return auth()->user();
    }

    public function render()
    {
        return view('livewire.classes.index', [
            'classes' => Classes::with('subjects')
                // ->when($this->user->isSubAdministrator(), fn($query) => $query->where('school_id', $this->user->school_id))
                ->get()
        ]);
    }
}
