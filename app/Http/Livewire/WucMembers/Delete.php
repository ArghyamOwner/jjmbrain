<?php

namespace App\Http\Livewire\WucMembers;

use App\Http\Livewire\DeleteModal;
use App\Models\WucMember;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class Delete extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        $model = WucMember::findOrFail($this->deleteModalId);
        $model->delete();
    
        $this->emit('refreshData');
    
        $this->closeDeleteModal();    
    
        $this->notify('WUC Member Deleted Successfully.');
    }
}
