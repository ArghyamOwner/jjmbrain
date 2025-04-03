<?php

namespace App\Http\Livewire\DivisionDashboard;

use App\Models\SchemeBinaryData;
use Livewire\Component;

class SchemeBinaryDataReport extends Component
{
    public $divisionId;

    public function mount($division)
    {
        $this->divisionId = $division;
    }

    public function render()
    {
        $data = SchemeBinaryData::query()
            ->with('scheme:id,name,total_cost,division_id,imis_id')
            ->whereRelation('scheme', 'division_id', $this->divisionId)
            ->get()->transform(fn($item) => [
                'id' => $item->scheme?->id,
                'imis_id' => $item->scheme?->imis_id,
                'name' => $item->scheme?->name,
                'amount' => $item->scheme?->total_cost,
                'source' => $item->source,
                'source_date' => "Date : ".$item->source_date?->format('d-m-Y'),
                'tp' => $item->tp,
                'tp_date' => "Date : ".$item->tp_date?->format('d-m-Y'),
                'ugr' => $item->ugr,
                'ugr_date' => "Date : ".$item->ugr_date?->format('d-m-Y'),
                'esr' => $item->esr,
                'esr_date' => "Date : ".$item->esr_date?->format('d-m-Y'),
                'pump_house' => $item->pump_house,
                'pump_house_date' => "Date : ".$item->pump_house_date?->format('d-m-Y'),
                'apdcl' => $item->apdcl,
                'apdcl_date' => "Date : ".$item->apdcl_date?->format('d-m-Y'),
                'internal_connection' => $item->internal_connection,
                'internal_connection_date' => "Date : ".$item->internal_connection_date?->format('d-m-Y'),
                'gen_set' => $item->gen_set,
                'gen_set_date' => "Date : ".$item->gen_set_date?->format('d-m-Y'),
                'lds' => $item->lds,
                'lds_date' => "Date : ".$item->lds_date?->format('d-m-Y'),
                'site_development' => $item->site_development,
                'site_development_date' => "Date : ".$item->site_development_date?->format('d-m-Y'),
                'boundary_wall' => $item->boundary_wall,
                'boundary_wall_date' => "Date : ".$item->boundary_wall_date?->format('d-m-Y'),
                'painting' => $item->painting,
                'painting_date' => "Date : ".$item->painting_date?->format('d-m-Y'),
                'rwp' => $item->rwp,
                'rwp_date' => "Date : ".$item->rwp_date?->format('d-m-Y'),
                'cwp' => $item->cwp,
                'cwp_date' => "Date : ".$item->cwp_date?->format('d-m-Y'),
                'network' => $item->network,
                'network_date' => "Date : ".$item->network_date?->format('d-m-Y'),
                'fhtc' => $item->fhtc,
                'fhtc_date' => "Date : ".$item->fhtc_date?->format('d-m-Y'),
                'trial_run' => $item->trial_run,
                'trial_run_date' => "Date : ".$item->trial_run_date?->format('d-m-Y'),
                'work_completion' => $item->work_completion,
                'work_completion_date' => "Date : ".$item->work_completion_date?->format('d-m-Y'),
                'scheme_handover' => $item->scheme_handover,
                'scheme_handover_date' => "Date : ".$item->scheme_handover_date?->format('d-m-Y'),
                'panchayat_verified' => $item->panchayat_verified,
                'panchayat_verified_date' => "Date : ".$item->panchayat_verified_date?->format('d-m-Y'),
        ])->sortBy('name')->values();

        return view('livewire.division-dashboard.scheme-binary-data-report', [
            'data' => $data,
        ]);
    }
}
