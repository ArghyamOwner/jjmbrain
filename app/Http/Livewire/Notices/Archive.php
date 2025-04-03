<?php

namespace App\Http\Livewire\Notices;

use App\Http\Livewire\DeleteModal;
use App\Models\Notice;

class Archive extends DeleteModal
{
    public function destroy()
    {
        $model = Notice::findOrFail($this->deleteModalId);
        if ($model->status == Notice::STATUS_ACTIVE) {
            $model->status = Notice::STATUS_ARCHIVE;
        } else {
            $model->status = Notice::STATUS_ACTIVE;
        }
        $model->save();
        $this->emit('refreshData');
        $this->closeDeleteModal();
        $this->notify('Notice Updated.');
    }
}
