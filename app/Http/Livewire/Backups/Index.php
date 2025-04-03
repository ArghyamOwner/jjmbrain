<?php

namespace App\Http\Livewire\Backups;

use Illuminate\Support\Facades\Storage;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        if (!(auth()->user()->email === 'admin@test.test' || auth()->user()->email === 'admin.ho@jjmbrain.in')) {
            abort(403, 'Unauthorized action.');
        }

        return view('livewire.backups.index', [
            'directories' => Storage::disk('backups')->allFiles('JJM-Brain-Database'),
        ]);
    }
}
