<?php

namespace App\Http\Livewire\Tenants\Services;

use App\Models\Service;
use App\Traits\WithSlideover;
use Livewire\Component;

class ServiceEditModal extends Component
{
    use WithSlideover;

    public $service;
    public $title;

    protected $listeners = [
        'editServiceSlideover' => 'openModal'
    ];

    protected function rules()
    {
        return [
            'service.title' => ['required', 'string'],
            'service.link' => ['required', 'url'],  
        ];
    }

    public function openModal($id)
    {
        $this->show = true;
        $this->service = Service::where('id', $id)->first();
        $this->title = $this->service->title;
    }

    public function update()
    {
        $this->validate();

        $this->service->save();

        $this->service->refresh();

        $this->emit('refreshServices');

        $this->notify('saved');

        $this->close();
    }

    public function render()
    {
        return view('livewire.tenants.services.service-edit-modal');
    }
}
