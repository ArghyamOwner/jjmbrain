<?php

namespace App\Http\Livewire\Wucs;

use App\Models\Isa;
use App\Traits\InteractsWithBanner;
use Livewire\Component;

class AssignIsa extends Component
{
    use InteractsWithBanner;

    public $wuc;
    public $isa_ids = [];

    public function mount($wuc)
    {
        $this->wuc = $wuc->loadMissing('schemes.villages');
    }

    public function assignIsa()
    {
        $validate = $this->validate([
            'isa_ids' => ['required']
        ]);

        $this->wuc->isas()->sync($validate['isa_ids']);
        $this->banner('ISA assigned Successfully.');
        return redirect()->route('wucs.show', $this->wuc->id);
    }

    public function render()
    {
        $villageIds = $this->wuc->schemes->flatMap(function ($scheme) {
            return $scheme->villages->pluck('id');
        })->unique();

        return view('livewire.wucs.assign-isa', [
            'isaList' => Isa::query()
                ->whereHas('villages', fn($q) => $q->whereIn('village_id', $villageIds))
                ->get()
                ->map(fn($item) => [
                    'label' => $item->name,
                    'value' => $item->id,
                ])
                ->all(),
        ]);
    }
}
