<?php

namespace App\Http\Resources;

use App\Http\Resources\SubjectResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassResource extends JsonResource
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
            'class_name' => $this->class_name,
            'grade' => $this->class_grade,
            $this->mergeWhen($this->whenLoaded('subjects'), fn() => [
                'subjects' => SubjectResource::collection($this->subjects)
            ]),
        ];
    }
}
