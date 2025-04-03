<?php

namespace App\Http\Livewire\Tenants\Sliders;

use App\Models\Slider;
use App\Http\Livewire\DeleteModal;

class Delete extends DeleteModal
{
    public function destroy()
    {
        $slider = Slider::findOrFail($this->deleteModalId);
		$slider->delete();
        
        $this->emit('refreshSlidersPage');
        $this->notify('Slider image deleted!');
        
        $this->closeDeleteModal();
    }
}