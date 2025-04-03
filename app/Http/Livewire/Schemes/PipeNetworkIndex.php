<?php

namespace App\Http\Livewire\Schemes;

use App\Models\SchemePipeNetwork;
use Livewire\Component;

class PipeNetworkIndex extends Component
{
    public $schemeId;
    public $showDeleteButton = false;

    protected $listeners = [
        'refreshData' => '$refresh',
    ];

    public function render()
    {
        if(auth()->user()->isAdministrator()){
            $this->showDeleteButton = true;
        }
        return view('livewire.schemes.pipe-network-index', [
            'networks' => SchemePipeNetwork::query()
                ->with('createdBy:id,name', 'verifiedBy:id,name')
                ->where('scheme_id', $this->schemeId)
                // ->when($this->search != '', fn($query) => $query->whereLike(['item_name', 'asset_uin'], $this->search))
                ->latest('id')
                ->get(),
        ]);
    }
}
