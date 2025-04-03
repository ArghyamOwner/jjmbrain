<?php

namespace App\Http\Livewire\Jalshalas;

use App\Http\Livewire\DeleteModal;
use App\Models\Trainer;

class DeleteTrainer extends DeleteModal
{
    public function destroy()
    {
        $model = Trainer::findOrFail($this->deleteModalId);

        $model->delete();

        $this->closeDeleteModal();    

        $this->emit('refreshData');

        $this->notify('Trainer deleted.');
    }
}
