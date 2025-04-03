<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectResource extends JsonResource
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
            'subject_name' => $this->subject_name,
            'subject_code' => $this->subject_code,
            'subject_formatted' => $this->subject_name_formatted,
            'links' => [
                'textbooks' => route('textbooks', [
                    'class' => $this->class_id,
                    'subject' => $this->id
                ]),
                'videos' => route('videos', [
                    'class' => $this->class_id,
                    'subject' => $this->id
                ])
            ]
        ];
    }
}
