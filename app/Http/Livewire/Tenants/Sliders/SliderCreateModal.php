<?php

namespace App\Http\Livewire\Tenants\Sliders;

use App\Models\Slider;
use App\Traits\WithSlideover;
use Livewire\Component;
use Livewire\WithFileUploads;

class SliderCreateModal extends Component
{
    use WithFileUploads;
    use WithSlideover;

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
        $this->close();
    }

    public function render()
    {
        return view('livewire.tenants.sliders.slider-create-modal');
    }
}
