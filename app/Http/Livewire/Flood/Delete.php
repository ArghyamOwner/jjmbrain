<?php

namespace App\Http\Livewire\Flood;
use App\Http\Livewire\DeleteModal;
use App\Models\SchemeFloodInfo;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = SchemeFloodInfo::findOrFail($this->deleteModalId);
        
		$model->delete();

        $this->emit('refreshData');

        $this->closeDeleteModal();    

        $this->notify('Flood Info deleted.');
    }
}

