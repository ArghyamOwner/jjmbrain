<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class School extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'district_id',
        'education_block_id',
        'school_name',
        'school_code',
        'category',
        'location',
        'drink_water',
        'hand_pump',
        'electricity',
        'latitude',
        'longitude'
    ];

    public function educationBlock()
    {
        return $this->belongsTo(EducationBlock::class);
    }
}
