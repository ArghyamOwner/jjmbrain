<?php

namespace App\Http\Livewire\Tenants\Services;

use App\Models\Service;
use Livewire\Component;

class StatusUpdate extends Component
{
    public $serviceId;
    public $status;

    public function updatedStatus()
    {
        if (is_null($this->service->published_at)) {
            $this->service->published_at = now();
        } else {
            $this->service->published_at = null;
        }

        $this->service->save();

        $this->emit('refreshServices');

        $this->notify('Service status updated.');
    }

    public function getServiceProperty()
    {
        return Service::findOrFail($this->serviceId);
    }

    public function render()
    {
        return view('livewire.tenants.services.status-update');
    }
}
