<?php

namespace App\Http\Livewire\Wucs;

use App\Models\PanchayatPayment;
use Livewire\Component;

class PanchayatPaymentsIndex extends Component
{
    public $wuc;

    protected $listeners = [
        'refreshData' => '$refresh'
    ];

    public function render()
    {
        return view('livewire.wucs.panchayat-payments-index', [
            'payments' => PanchayatPayment::query()
                ->with('jalmitra:id,name,phone', 'scheme:id,name,old_scheme_id,imis_id', 'panchayat:id,panchayat_name')
                ->where('wuc_id', $this->wuc)
                ->get(),
        ]);
    }
}
