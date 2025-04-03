<?php

namespace App\Http\Livewire\Lithologs;

use App\Http\Livewire\DeleteModal;
use App\Models\CasingDiagram;
use App\Traits\InteractsWithBanner;

class DeleteCasingDiagram extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        CasingDiagram::where('litholog_id', $this->deleteModalId)->delete();

        // $this->emit('refreshData');

        // $this->closeDeleteModal();

        $this->banner('Casing Diagram data deleted.');
        return redirect()->route('lithologs.show', $this->deleteModalId);

        // $this->notify('Casing Diagram data deleted.');
    }
}
