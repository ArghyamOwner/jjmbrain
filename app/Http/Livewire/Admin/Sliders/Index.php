<?php

namespace App\Http\Livewire\Admin\Sliders;

use App\Models\Slider;
use Livewire\Component;

class Index extends Component
{
    protected $listeners = [
        'refreshSlidersPage' => '$refresh'
    ];

    public function updateSliderOrder($orderIds)
    {
        if (count($orderIds)) {
            foreach($orderIds as $order){
                $this->saveSliderImageOrder($order);
            }
    
            $this->emit('$refresh');
            $this->notify('Slider image order updated.');
        }
    }

    protected function saveSliderImageOrder($order)
    {
        $slider = Slider::find($order['value']);
        
        if ($slider) {
            $slider->order = $order['order'];
            $slider->save();
        }
    }
    
    public function render()
    {
        $sliders = Slider::orderBy('order')->get();

        return view('livewire.admin.sliders.index', [
            'sliders' => $sliders,
            'slidersCount' => $sliders->count()
        ]);
    }
}
