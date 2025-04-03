<?php

namespace App\Http\Livewire\Jalshalas;

use App\Http\Livewire\DeleteModal;
use App\Models\Jaldoot;
use Livewire\Component;

class DeleteJaldoot extends DeleteModal
{
    public function destroy()
    {
        $model = Jaldoot::findOrFail($this->deleteModalId);

        $model->delete();

        $this->closeDeleteModal();    

        $this->emit('refreshData');

        $this->notify('Jaldoot deleted.');
    }
}
