<?php

namespace App\Http\Livewire\Jalshalas;

use App\Http\Livewire\DeleteModal;
use App\Models\JalshalaSchool;
use Livewire\Component;

class DeleteSchool extends DeleteModal
{
    public function destroy()
    {
        $model = JalshalaSchool::with('jaldoots')->findOrFail($this->deleteModalId);

        $model->jaldoots()->delete();
        $model->delete();

        $this->closeDeleteModal();    

        $this->emit('refreshData');

        $this->notify('School deleted.');
    }
}
