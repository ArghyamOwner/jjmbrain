<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContractorDocumentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array 
    {
        return [
            // 'document_type' => $this->document_type,
            'document_name' => $this->document_name,
            'document_url' => $this->document_url,
            // 'path' => $this->path,
            'size' => $this->size,
            'extension' => $this->extension,
        ];
    }
}
