<?php

namespace App\Http\Livewire\Wucs;

use App\Models\Wuc;
use Livewire\Component;

class Show extends Component
{
    public $wuc;
    public $showQuickActions = true;

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function mount(Wuc $wuc)
    {
        $this->wuc = $wuc->load(
            'district',
            'block',
            'schemes:id,name,scheme_status,district_id,block_id,division_id,old_scheme_id,imis_id',
            'schemes.division',
            'schemes.district',
            'schemes.blocks',
            'revenueCircle'
        )->loadExists('wucDocuments');

        if(auth()->user()->isWucAuditor()){
            $this->showQuickActions = false;
        }
    }

    public function render()
    {
        return view('livewire.wucs.show');
    }
}
