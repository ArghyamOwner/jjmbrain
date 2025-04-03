<?php

namespace App\Http\Livewire\Contractors;

use App\Enums\ContractorTypes;
use App\Models\ContractorDetail;
use App\Models\SchemeActivity;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public $contractor;

    public function mount(ContractorDetail $contractor)
    {
        $this->contractor = $contractor->load('user:id,name,phone,email,blocked_at,blocked_by');
    }

    public function blockUser()
    {
        $this->contractor->user->update([
            'blocked_at' => now(),
            'blocked_by' => Auth::id()
        ]);

        SchemeActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => 'user_blocked',
            'content' => 'Blocked',
            'feedable_type' => get_class($this->contractor->user),
            'feedable_id' => $this->contractor->user_id
        ]);

        $this->dispatchBrowserEvent('hide-modal');
        $this->emit('refreshData');
        $this->notify('User has been blocked.');
    }

    public function unblockUser()
    {
        $this->contractor->user->update([
            'blocked_at' => NULL,
            'blocked_by' => Auth::id()
        ]);

        SchemeActivity::create([
            'user_id' => auth()->id(),
            'activity_type' => 'user_blocked',
            'content' => 'Un-Blocked',
            'feedable_type' => get_class($this->contractor->user),
            'feedable_id' => $this->contractor->user_id
        ]);

        $this->dispatchBrowserEvent('hide-modal');
        $this->emit('refreshData');
        $this->notify('User has been unblocked.');
    }
    
    public function render()
    {
        return view('livewire.contractors.show');
    }
}
