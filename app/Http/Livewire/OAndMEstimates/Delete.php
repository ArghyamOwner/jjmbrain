<?php

namespace App\Http\Livewire\OAndMEstimates;

use App\Http\Livewire\DeleteModal;
use App\Models\OAndMEstimate;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = OAndMEstimate::findOrFail($this->deleteModalId);
		$model->delete();

        $this->emit('refreshData');

        $this->closeDeleteModal();    

        $this->notify('O & M Estimate deleted.');
    }
}