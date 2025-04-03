<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LogOfNotification extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'data',
    ];

    protected $casts = [
        'data' => 'array'
    ];
}
