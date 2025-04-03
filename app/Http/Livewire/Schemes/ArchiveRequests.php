<?php

namespace App\Http\Livewire\Schemes;

use App\Models\SchemeArchiveRequest;
use Livewire\Component;

class ArchiveRequests extends Component
{
    public $schemeId;

    public function render()
    {
        return view('livewire.schemes.archive-requests', [
            'requests' => SchemeArchiveRequest::query()
                ->with('division')
                ->where('scheme_id', $this->schemeId)
                ->latest('id')
                ->get(),
        ]);
    }
}
