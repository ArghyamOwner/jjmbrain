<?php

namespace App\Http\Livewire\JalAddas;

use App\Http\Livewire\DeleteModal;
use App\Models\JalAddaStudent;
use Livewire\Component;

class DeleteStudent extends DeleteModal
{
    public function destroy()
    {
        $model = JalAddaStudent::findOrFail($this->deleteModalId);

        $model->delete();

        $this->closeDeleteModal();    

        $this->emit('refreshData');

        $this->notify('Student deleted.');
    }
}
