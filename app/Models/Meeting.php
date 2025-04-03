<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Meeting extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'title',
        'venue',
        'date_time',
        'description',
    ];

    protected $casts = [
        'date_time' => 'datetime'
    ];
}
