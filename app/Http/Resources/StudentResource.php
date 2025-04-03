<?php

namespace App\Http\Resources;

use App\Http\Resources\StudentUserResource;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'student_photo' => $this->photo_url,
            'grade' => $this->grade,
            'section' => $this->section,
            'status' => $this->status,
            $this->mergeWhen($this->whenLoaded('user'), fn() => new StudentUserResource($this->user))
        ];
    }
}
