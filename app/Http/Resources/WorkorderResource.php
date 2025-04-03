<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WorkorderResource extends JsonResource
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
            'workorder_name' => $this->workorder_name,
            'workorder_number' => $this->workorder_number,
            'workorder_type' => $this->workorder_type,
            'workorder_funding_agency' => $this->workorder_funding_agency,
            'workorder_amount' => $this->workorder_amount,
            'workorder_type' => $this->workorder_type,
            'workorder_status' => $this->workorder_status,
            'workorder_estimated_date' => [
                'human' => $this->workorder_estimated_date?->diffForHumans(),
                'date' => $this->workorder_estimated_date?->toDateString(),
                'formatted' => $this->workorder_estimated_date?->toFormattedDateString(),
            ],
            'division' => $this->division?->name,
            'schemes_count' => $this->schemes_count,
            'aa_number' => $this->aa_number,
            'ts_number' => $this->ts_number,
            'schemes' => $this->whenLoaded('schemes', fn() => $this->schemes->pluck('name')->join(', ')),
            'contractor' => $this->whenLoaded('contractor', fn() => [
                'id' => $this->contractor?->id,
                'name' => $this->contractor?->name,
                'email' => $this->contractor?->email,
                'phone' => $this->contractor?->phone,
            ])
        ];
    }
}
