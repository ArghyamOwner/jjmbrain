<?php

namespace App\Http\Livewire\SchemeArchiveRequest;

use App\Models\Scheme;
use App\Models\SchemeArchiveRequest;
use App\Traits\InteractsWithBanner;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Create extends Component
{
    use InteractsWithBanner;

    public $scheme;
    public $reason;

    public function mount(Scheme $scheme)
    {
        $this->scheme = $scheme;
    }

    public function request()
    {
        $validatedData = $this->validate([
            'reason' => ['required', 'max:200'],
        ]);
        $exists = SchemeArchiveRequest::where('scheme_id', $this->scheme->id)->where('status', SchemeArchiveRequest::STATUS_PENDING)->exists();
        if ($exists) {
            return $this->notify('Scheme Archive cannot be Requested. A Request for this Scheme is already in Pending State', 'error');
        }

        SchemeArchiveRequest::create($validatedData + [
            'scheme_id' => $this->scheme->id,
            'created_by' => Auth::id(),
            'scheme_name' => $this->scheme->name ?? null,
            'division_id' => $this->scheme->division_id ?? null,
            'smt_id' => $this->scheme->old_scheme_id ?? null,
            'imis_id' => $this->scheme->imis_id ?? null,
        ]);

        // Activity::create([
        //     'user_id' => auth()->user()->id,
        //     'scheme_id' => $this->scheme->id,
        //     'activity_type' => "scheme_deletion_request",
        //     'activity_description' => "For Scheme Uin:" . $this->scheme->scheme_uin . ", Deletion Request has been created by " . auth()->user()->name,
        //     'activity_division' => [intval($this->scheme->subdivision_id)] ?? null,
        // ]);
        $this->dispatchBrowserEvent('hide-modal');
        $this->emit('refreshData');
        $this->notify('Scheme Archive Request has been Created Successfully !');
    }

    public function render()
    {
        return view('livewire.scheme-archive-request.create');
    }
}
