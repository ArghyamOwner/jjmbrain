<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lac extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'name',
    ];
}
