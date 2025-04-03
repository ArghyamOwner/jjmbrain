<?php

namespace App\Http\Livewire\Wucs;

use Livewire\Component;

class DocumentIndex extends Component
{
    public $wuc;

    public function mount($wuc)
    {
        $this->wuc = $wuc->loadMissing('wucDocuments.createdBy:id,name');
    }

    public function render()
    {
        return view('livewire.wucs.document-index');
    }
}
