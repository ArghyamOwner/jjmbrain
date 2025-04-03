<?php

namespace App\Http\Livewire\SchemeArchiveRequest;

use App\Models\Scheme;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UpdateStatus extends Component
{
    use InteractsWithBanner;

    public $request;
    public $status;
    public $comment;

    public function mount($request)
    {
        $this->request = $request;
    }

    public function updateStatus()
    {
        $validatedData = $this->validate([
            'status' => ['required'],
            'comment' => ['required', 'max:200'],
        ]);

        $this->request->update($validatedData + [
            'checked_by' => Auth::id(),
        ]);

        $this->banner('Status Updated Successfully !!');
        return redirect()->route('archiveRequests.show', $this->request->id);
    }

    public function render()
    {
        return view('livewire.scheme-archive-request.update-status');
    }
}
