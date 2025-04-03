<?php

namespace App\Http\Livewire\Admin\Sliders;

use App\Models\Slider;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreateModal extends Component
{
    use WithFileUploads;

    public $openSlideover = false;
    public $image;

    protected $listeners = [
        'openSliderCreateSlideover'
    ];

    public function openSliderCreateSlideover()
    {
        $this->openSlideover = true;
    }

    public function save()
    {
        $this->validate([
            'image' => ['required', 'image', 'max:2048']
        ]);

        Slider::create([
            'image' => $this->image->store('/', 'public'),
            'published_at' => now(),
            'order' => Slider::max('order') + 1
        ]);

        $this->notify('Slider image saved.');
        $this->emit('refreshSlidersPage');
        $this->dispatchBrowserEvent('destroy-filepond');
        $this->openSlideover = false;
    }

    public function render()
    {
        return view('livewire.admin.sliders.create-modal');
    }
}
