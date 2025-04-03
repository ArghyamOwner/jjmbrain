<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BeneficiaryResource extends JsonResource
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
            'beneficiary_name' => $this->beneficiary_name,
            'beneficiary_phone' => $this->beneficiary_phone,
            'beneficiary_voter_number' => $this->beneficiary_voter_number,
            'beneficiary_aadhaar' => $this->beneficiary_aadhaar,
            "beneficiary_photo" => [
                "image_original" => $this->beneficiary_photo_url,
                "img_meta" => [
                    "img_thumb" => null,
                    "img_large" => null
                ]
            ],
            'address' => $this->address,
            'latitude' => $this->latitude,
            'longitude' => $this->longitude,
            'fhtc_number' => $this->fhtc_number,
        ];
    }
}
