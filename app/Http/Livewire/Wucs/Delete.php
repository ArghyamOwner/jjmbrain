<?php

namespace App\Http\Livewire\Wucs;

use App\Http\Livewire\DeleteModal;
use App\Models\Wuc;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = Wuc::with('schemes')->findOrFail($this->deleteModalId);
		$model->delete();
        $this->emit('refreshData');
        $this->closeDeleteModal();    
    }
}
