<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class JalmitraSchemeResource extends JsonResource
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
            'imis' => $this->imis_id,
            'smt' => $this->old_scheme_id,
            'division' => $this->division_name,
            'district' => $this->district_name,
            'blocks' => $this->block_names,
            'panchayats' => $this->panchayat_names,
            'villages' => $this->village_names,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'section_officers' => $this->whenLoaded('users', fn() => UserResource::collection($this->users)),
            'wucs' => $this->whenLoaded('wucs', fn() => WucResource::collection($this->wucs)),
        ];
    }
}
