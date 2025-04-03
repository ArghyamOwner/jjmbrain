<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeviceCommand extends Model
{
    use HasFactory, HasUlids;
    
    protected $fillable = [
        'id',
        'scheme_id',
        'user_id',
        'command',
        'type',
        'description',
    ];

}
