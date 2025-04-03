<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class AttendanceTeacherResource extends JsonResource
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
            'status' => 'present',
            'date' => [
                'day' => intval($this->attendance_date?->format('d')),
                'date' => $this->attendance_date?->toDateString(),
                'formatted' => $this->attendance_date?->toFormattedDateString(),
            ],
        ];
    }
}
