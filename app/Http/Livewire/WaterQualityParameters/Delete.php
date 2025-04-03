<?php

namespace App\Http\Livewire\WaterQualityParameters;

use App\Http\Livewire\DeleteModal;
use App\Models\WaterQualityParameter;

class Delete extends DeleteModal
{
    public function destroy() 
    {
        $model = WaterQualityParameter::findOrFail($this->deleteModalId);
        $model->delete();
    
        $this->emit('refreshData');
    
        $this->closeDeleteModal();    
    
        $this->notify('Water Quality Parameter removed.');
    }
}
