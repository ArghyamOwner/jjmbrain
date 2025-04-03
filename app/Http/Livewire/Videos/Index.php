<?php

namespace App\Http\Livewire\Videos;

use App\Models\Video;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.videos.index', [
            'videos' => Video::with(['class', 'subject'])->fastPaginate()
        ]);
    }
}
