<?php

namespace App\Http\Resources;

use App\Enums\UserRole;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentUserResource extends JsonResource
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
            'type' => 'user',
            'id' => $this->user->id,
            'attributes' => [
                'student_id' => $this->id,
                'school_id' => $this->user->school_id,
                'name' => $this->user->name,
                'email' => $this->user->email,
                'role' => $this->user->role,
                'phone' => $this->user->phone,
                'username' => $this->user->school_code,
                'student_photo' => $this->photo_url,
                $this->mergeWhen($this->whenLoaded('class'), fn() => [
                    'grade' => $this->class?->class_grade,
                    'class_id' => $this->class?->id
                ]),
                'section' => $this->section,
                'status' => $this->status,
                'created' => [
                    'human' => $this->created_at->diffForHumans(),
                    'date' => $this->created_at->toDateString(),
                    'formatted' => $this->created_at->toFormattedDateString(),
                ],
            ],
            'relationships' => [],
            'links' => []
        ];
    }    
}
