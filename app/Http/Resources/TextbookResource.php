<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class TextbookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'textbook_title' => $this->textbook_title,
            'textbook_description' => $this->textbook_description,
            'textbook_link' => $this->textbook_link,
            'textbook_image' => $this->textbook_image_url,
        ];
    }
}
