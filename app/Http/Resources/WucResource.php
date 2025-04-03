<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WucResource extends JsonResource
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
            'name' => $this->name,
            'scheme_names' => $this->scheme_names,
            'district' => $this->district?->name,
            'revenue_circle' => $this->revenueCircle?->name,
            'block' => $this->block?->name,
            'formation_date' => [
                'human' => $this->formation_date?->diffForHumans(),
                'date' => $this->formation_date?->toDateString(),
                'formatted' => $this->formation_date?->toFormattedDateString(),
            ],
            'approval_date' => [
                'human' => $this->approval_date?->diffForHumans(),
                'date' => $this->approval_date?->toDateString(),
                'formatted' => $this->approval_date?->toFormattedDateString(),
            ],
            'approval_document_url' => $this->approval_document_url,
            'constitution_document_url' => $this->constitution_document_url,
            'bank_name' => $this->bank_name,
            'account_number' => $this->account_number,
            'ifsc' => $this->ifsc,
            'fhtc' => $this->fhtc,
            'household' => $this->household,
            'tariff_per_hh' => $this->tariff_per_hh,
            'members' => $this->whenLoaded('wucMembers', fn() => WucMemberResource::collection($this->wucMembers)),
            'presidents' => $this->whenLoaded('wucPresidents', fn() => WucMemberResource::collection($this->wucPresidents)),
        ];
    }
}
