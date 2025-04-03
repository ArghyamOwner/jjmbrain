<?php

namespace App\Http\Livewire\ContractorDocuments;

use App\Http\Livewire\DeleteModal;
use App\Models\ContractorDocument;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $model = ContractorDocument::findOrFail($this->deleteModalId);
		$model->delete();

        $this->emit('refreshData');

        $this->closeDeleteModal();    

        $this->notify('Document deleted.');
    }
}
