<?php

namespace App\Http\Livewire\Schemes;

use App\Http\Livewire\DeleteModal;
use App\Models\DeviceCommand;

class IotDeviceRemoved extends DeleteModal
{
    public function destroy()
    {
        $device = DeviceCommand::findOrFail($this->deleteModalId);
		$device->delete();
        $this->emit('refreshSlidersPage');
        $this->notify('Device Command deleted!');
        $this->closeDeleteModal();
    }
}
