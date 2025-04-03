<?php

namespace App\Http\Livewire\SchemeArchiveRequest;

use App\Models\SchemeArchiveRequest;
use Livewire\Component;

class Show extends Component
{
    public $request;
    public $showCancelButton = true;
    public $showDeleteRequestOption = false;

    public function mount(SchemeArchiveRequest $request)
    {
        $this->request = $request->load('createdBy:id,name,phone', 'checkedBy:id,name,phone');
    }

    public function render()
    {
        if((auth()->user()->id === $this->request->created_by || auth()->user()->isAdministrator()))
        {
            if($this->request->status === SchemeArchiveRequest::STATUS_PENDING){
                $this->showDeleteRequestOption = true;
            }
        }

        return view('livewire.scheme-archive-request.show');
    }
}
