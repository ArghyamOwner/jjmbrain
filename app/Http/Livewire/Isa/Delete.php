<?php

namespace App\Http\Livewire\Isa;

use App\Http\Livewire\DeleteModal;
use App\Models\Isa;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = Isa::findOrFail($this->deleteModalId);
        $model->delete();
        $this->closeDeleteModal();
        $this->emit('refreshData');
        $this->notify('ISA deleted.');
        return redirect()->route('isa');
    }
}
