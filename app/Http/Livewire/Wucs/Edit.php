<?php

namespace App\Http\Livewire\Wucs;

use Livewire\Component;

class Edit extends Component
{
    public $wuc;
    public $name;

    public function mount()
    {
        $this->name = $this->wuc->name;
    }

    public function update()
    {
        $validatedData = $this->validate([
            'name' => ['required'],
        ]);
        $this->wuc->update([
            'name' => $validatedData['name'],
        ]);

        // $this->closeModal();s
        $this->emit('refreshData');
        $this->notify('Updated.');
        $this->dispatchBrowserEvent('hide-modal');
    }

    public function render()
    {
        return view('livewire.wucs.edit');
    }
}
