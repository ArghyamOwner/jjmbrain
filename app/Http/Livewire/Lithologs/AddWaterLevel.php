<?php

namespace App\Http\Livewire\Lithologs;

use App\Models\Pattern;
use App\Models\WaterLevel;
use App\Rules\LithologMaxEndValueRule;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class AddWaterLevel extends Component
{
    use InteractsWithBanner;

    public $litholog;
    public $pattern_id;
    public $start;
    public $end;
    public $type;
    public $remarks;

    public function mount($litholog)
    {
        $this->litholog = $litholog;
       
    }

    public function getPatternsProperty()
    {
        return Pattern::where('type', Pattern::TYPE_WATER_LEVEL)->orderBy('category')->pluck('category', 'id')->all();
    }

    public function save()
    {
        $validate = $this->validate([
            'pattern_id' => ['required'],
            'start' => ['required'],
            'end' => ['required', 'gt:start', new LithologMaxEndValueRule($this->litholog->id)],
            // 'type' => ['required'],
            'remarks' => ['required'],
        ],[],[
            'pattern_id' => 'layer'
        ]);

        WaterLevel::create($validate + [
            'litholog_id' => $this->litholog->id,
        ]);

        // $this->emit('refreshData');

        // $this->dispatchBrowserEvent('hide-modal');

        // $this->notify('Water Level Data Added Successfully.');
        $this->banner('Water Level Data Added Successfully.');
        return redirect()->route('lithologs.show', $this->litholog->id);

    }

    public function render()
    {
        $this->start = WaterLevel::where('litholog_id', $this->litholog->id)->max('end') ?? 0;
        return view('livewire.lithologs.add-water-level');
    }
}
