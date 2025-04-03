<?php

namespace App\Http\Livewire\Notices;

use App\Http\Livewire\DeleteModal;
use App\Models\Notice;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = Notice::findOrFail($this->deleteModalId);
        $model->delete();
        $this->emit('refreshData');
        $this->closeDeleteModal();
        $this->notify('Notice deleted.');
    }
}
