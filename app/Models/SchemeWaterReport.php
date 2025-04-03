<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchemeWaterReport extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'water_quality_parameter_id',
        'value',
    ];

    public function waterQualityParameter()
    {
        return $this->belongsTo(WaterQualityParameter::class, 'water_quality_parameter_id');
    }
}
