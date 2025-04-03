<?php

namespace App\Http\Resources;

use App\Models\Beneficiary;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SchemeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'smt_id' => $this->old_scheme_id ?? 'N/A',
            'name' => $this->name,
            'scheme_uin' => $this->scheme_uin,
            'scheme_type' => $this->scheme_type,
            'work_status' => $this->work_status,
            'operating_status' => $this->operating_status,
            'panchayat' =>  $this->panchayat_names,
            'village' => $this->village_names,
			'habitation' => $this->habitation_names,
			'approved_on' => $this->approved_on,
			'imis_id' => $this->imis_id,
			'has_tea_garden' => (bool) $this->has_tea_garden,
			'planned_fhtc' => $this->planned_fhtc,
			'achieved_fhtc' => $this->achieved_fhtc,
            'beneficiaries_count' => Beneficiary::query()->where('scheme_id', $this->id)->count(),
			'latitude' => $this->latitude,
			'longitude' => $this->longitude,
            'financial_year' => $this->whenLoaded('financialYear', fn() => $this->financialYear->financialYear),
            'office' => $this->when(
                $this->relationLoaded('division') &&
                $this->division?->relationLoaded('circle'),
                fn () => $this->division?->circle?->name
            ),
            'division' => $this->division_name,
            'district' => $this->district_name,
            'block' => $this->block_names,
            'qr_installed' => $this->schemeQrReports->isNotEmpty() ? true : false ,
            // 'division' => $this->whenLoaded('division', fn() => $this->division->name),
            // 'district' => $this->whenLoaded('district', fn() => $this->district->name),
            // 'block' => $this->whenLoaded('block', fn() => $this->block->name),
            'workorders' => $this->whenLoaded('workorders', fn() => WorkorderResource::collection($this->workorders->load('contractor')))
        ];
    }
}
