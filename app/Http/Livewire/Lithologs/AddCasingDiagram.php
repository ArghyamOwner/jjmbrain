<?php

namespace App\Http\Livewire\Lithologs;

use App\Models\CasingDiagram;
use App\Models\Pattern;
use App\Rules\LithologMaxEndValueRule;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class AddCasingDiagram extends Component
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
        $this->start = CasingDiagram::where('litholog_id', $this->litholog->id)->max('end') ?? 0;
    }

    public function getPatternsProperty()
    {
        return Pattern::where('type', Pattern::TYPE_CASE_DIAGRAM)->orderBy('category')->pluck('category', 'id')->all();
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

        CasingDiagram::create($validate + [
            'litholog_id' => $this->litholog->id,
        ]);

        // $this->emit('refreshData');

        // $this->dispatchBrowserEvent('hide-modal');

        $this->banner('Casing Diagram Data Added Successfully.');
        return redirect()->route('lithologs.show', $this->litholog->id);
    }

    public function render()
    {
        return view('livewire.lithologs.add-casing-diagram');
    }
}
