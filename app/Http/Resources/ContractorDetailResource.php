<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\ContractorDocumentResource;

class ContractorDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'entity_name' => $this->entity_name,
            'business_type' => $this->business_type,
            'contractor_type' => $this->contractor_type,
            'approval_file' => $this->approval_file,

            'registerable_type' => $this->registerable_type,
            'registerable_id' => $this->registerable_id,

            'uin' => $this->uin,
            'gst' => $this->gst,
            'pan' => $this->pan,
            'departmental_registration_no' => $this->departmental_registration_no,
            'registration_number' => $this->registration_number,
            'registration_valid_upto' => $this->registration_valid_upto,
            'address' => $this->address,
            'bank_name' => $this->bank_name,
            'branch_name' => $this->branch_name,
            'account_number' => $this->account_number,
            'ifsc_code' => $this->ifsc_code,

            'user' => $this->whenLoaded('user', fn() => [
                'name' => $this->user->name,
                'email' => $this->user->email,
                'phone' => $this->user->phone,
                'role' => $this->user->role,
                'photo' => $this->photo_url,
            ]),

            'documents' => $this->whenLoaded('contractorDocuments', fn() => ContractorDocumentResource::collection($this->contractorDocuments)),
            'workorders_count' => $this?->user?->workorders?->count()
        ];
    }
}
