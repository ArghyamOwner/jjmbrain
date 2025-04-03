<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pattern extends Model
{
    use HasFactory;

    const TYPE_LITHOLOGY = 'lithology';
    const TYPE_CASE_DIAGRAM = 'case_diagram';
    const TYPE_WATER_LEVEL = 'water_level';

    protected $fillable = [
        'name',
        'number',
        'type'
    ];
}
