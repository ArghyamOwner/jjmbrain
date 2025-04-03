<?php

namespace App\Http\Livewire\Schemes;

use App\Models\Isa;
use App\Models\Scheme;
use Illuminate\Support\Str;
use Livewire\Component;

class Show extends Component
{
    public $schemeId;
    // public $showFlowmeterDeleteButton = false;

    protected $listeners = [
        'refreshSchemeStatus' => '$refresh',
        'refreshConsumerNo' => '$refresh',
        'refreshData' => '$refresh',
    ];

    public function getSchemeProperty()
    {
        return Scheme::query()
            ->with([
                'division.circle',
                'subdivisions',
                'division.zone',
                'district',
                'blocks',
                'villages',
                'panchayats',
                'habitations',
                'financialYear',
                'schemeShg',
                // 'flowmeterDetails.createdBy:id,name',
                'schemePanchayatVerification.verifiedBy:id,name',
                'schemePanchayatVerification.rejectedBy:id,name',
                'schemeDailyFlowmeter:status,image,updated_at'
            ])->findOrFail($this->schemeId);
    }

    public function render()
    {
        $cost = (int) $this->scheme->planned_fhtc ? round(($this->scheme->total_cost / $this->scheme->planned_fhtc), 2) : null;

        $villages = $this->scheme->villages->pluck('id')->all();

        // if(auth()->user()->isAdministrator() || auth()->user()->isSdo() || auth()->user()->isSectionOfficer()){
        //     $this->showFlowmeterDeleteButton = true;
        // }

        return view('livewire.schemes.show', [
            'scheme' => $this->scheme,
            'isas' => Isa::query()
                ->withWhereHas('villages', function ($query) use ($villages) {
                    $query->whereIn('village_id', $villages);
                })->get(),
            'costPerFhtc' => $cost ? (Str::money($cost) . '(' . Str::numberToWords($cost) . ')') : '-',
        ]);
    }
}
