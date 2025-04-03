<?php

namespace App\Http\Livewire\Jalshalas;

use App\Models\Scheme;
use Livewire\Component;
use App\Models\Jalshala;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use App\Traits\InteractsWithBanner;

class EditJalshalaScheme extends Component
{
    use InteractsWithBanner;

    public $jalshalaId;
    public $districtId;
    public $blockId;
    public $schemesArray = [];
    public $schemes;
    public $scheme;
    public $jalshala_uin;

    public function mount(Jalshala $jalshala)
    {
        $this->jalshalaId = $jalshala->id;
        $this->districtId = $jalshala->district_id;
        $this->blockId = $jalshala->block_id;
        $this->jalshala_uin = $jalshala->jalshala_uin;

        $this->schemes = $jalshala->schemes->pluck('id')->all();

        $this->schemesArray = Scheme::query()
            ->where('district_id', $this->districtId)
        // ->where('block_id', $this->blockId)
        //     ->whereHas('blocks', function ($q) {
        //         $q->where('block_id', $this->blockId);
        //     })
            ->get()
            ->transform(fn($item) => [
                'value' => $item->id,
                'label' => $item->name,
            ])->all();
    }

    public function update()
    {
        $validated = $this->validate([
            'scheme' => ['required'],
            'jalshala_uin' => ['required', Rule::unique('jalshalas')->ignore($this->jalshalaId)]
        ]);
        
        $this->jalshala->update([
            'jalshala_uin' => Str::upper($validated['jalshala_uin'])
        ]);

        $this->jalshala->schemes()->sync($validated['scheme']);


        $this->banner('Jal Shala updated.');

        return redirect()->route('jalshalas.index');
    }

    public function getJalshalaProperty()
    {
        return Jalshala::findOrFail($this->jalshalaId);
    }

    public function render()
    {
        return view('livewire.jalshalas.edit-jalshala-scheme');
    }
}
