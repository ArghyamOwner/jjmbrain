<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApiLog extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'method',
        'url',
        'route_name',
        'status_code',
        'ip_address',
        'response_time',
        'response_size',
        'user_id',
        'location',
        'user_agent',
        'platform',
        'platform_version',
        'browser_version',
        'auth_type',
        'error_details'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
