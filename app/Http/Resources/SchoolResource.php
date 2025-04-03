<?php

namespace App\Http\Resources;

use App\Models\School;
use App\Models\Amenity;
use Illuminate\Support\Str;
use Illuminate\Http\Resources\Json\JsonResource;

class SchoolResource extends JsonResource
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
            'district' => $this->district->name,
            'block' => $this->block->name,
            'name' => $this->name,
            'village' => $this->village,
            'cluster_code' => $this->cluster_code,
            'operation_type' => $this->operation_type,
            'school_geographic_area' => $this->school_geographic_area,
            'affiliated_board' => $this->affiliated_board,
            'management_type' => $this->management_type, 
            'school_category' => $this->school_category, 
            'uin_code' => $this->uin_code,
            'website' => $this->website,
            'phone' => $this->phone,
            'email' => $this->email,
            'street_address' => $this->street_address,
            'city' => $this->city,
            'state' => $this->state,
            'postal_code' => $this->postal_code,
            'address_formatted' => $this->school_address,
            'latitude' => $this->latitude ?? '',
            'longitude' => $this->longitude ?? '',
            'total_land_area' => $this->total_land_area ?? 0,
            'student_capacity' => $this->student_capacity ?? 0,
            'total_toilets' => $this->total_toilets ?? 0,
            'total_functional_toilets' => $this->total_functional_toilets ?? 0,
            'amenities' => $this->getAmenities($this)
        ];
    }

    protected function getAmenities($school)
    {
        $amenities = Amenity::pluck('name', 'id');

        return $amenities->flatMap(function($item, $key) use ($school) {
            if (! $school->amenities) {
                return [ 
                    [
                        "name" => $item,
                        "status" => false
                    ]
                ];
            } 

            if (collect($school->amenities->pluck('name'))->contains($item)) {
                return [  
                    [
                        "name" => $item,
                        "status" => true
                    ]
                ];
            } else {
                return [
                    [
                        "name" => $item,
                        "status" => false
                    ]
                ];
            }
        })->all();
    }
}
