<?php

namespace App\Http\Livewire\PerformanceGuarantees;

use App\Http\Livewire\DeleteModal;
use App\Models\PerformanceGuarantee;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = PerformanceGuarantee::findOrFail($this->deleteModalId);

        $model->delete();

        $this->emit('refreshData');

        $this->closeDeleteModal();

        $this->notify('PG Deleted Successfully.');
    }
}
