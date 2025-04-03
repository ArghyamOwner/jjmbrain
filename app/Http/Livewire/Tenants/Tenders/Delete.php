<?php

namespace App\Http\Livewire\Tenants\Tenders;

use App\Models\Tenderdocument;
use App\Http\Livewire\DeleteModal;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $tenderDocument = Tenderdocument::findOrFail($this->deleteModalId);
       
        $tenderDocument->delete();

        $this->emit('refreshData');

        $this->bannerMessage('Tender deleted!');

        $this->closeDeleteModal();
    }
}
