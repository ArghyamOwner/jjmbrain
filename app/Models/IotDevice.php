<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IotDevice extends Model
{
    use HasFactory, HasUlids;
    
    protected $fillable = [
        'id',
        'scheme_id',
        'mqtt_username',
        'mqtt_password',
        'mqtt_device_id',
    ];
}
