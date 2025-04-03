<?php

namespace App\Http\Livewire\Lithologs;

use App\Http\Livewire\DeleteModal;
use App\Models\WaterLevel;
use App\Traits\InteractsWithBanner;

class DeleteWaterLevel extends DeleteModal
{
    use InteractsWithBanner;

    public function destroy()
    {
        WaterLevel::where('litholog_id', $this->deleteModalId)->delete();

        // $this->emit('refreshData');

        // $this->closeDeleteModal();

        $this->banner('Water Level data deleted.');
        return redirect()->route('lithologs.show', $this->deleteModalId);
    }
}
