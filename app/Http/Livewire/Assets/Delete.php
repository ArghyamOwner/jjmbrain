<?php

namespace App\Http\Livewire\Assets;

use App\Http\Livewire\DeleteModal;
use App\Models\Asset;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = Asset::findOrFail($this->deleteModalId);
        
		$model->delete();

        $this->emit('refreshData');

        $this->closeDeleteModal();    

        $this->notify('Asset deleted.');
    }
}
