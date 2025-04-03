<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaterQualityParameter extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'parameter_name',
        'parameter_cycle',
        'parameter_unit',
        'safe_limit_max',
        'safe_limit_min',
    ];
}
