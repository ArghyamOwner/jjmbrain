<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeVendor extends Model
{
    use HasFactory, HasUlids;

    protected $table = 'scheme_vendor';
    protected $fillable = [
        'id',
        'scheme_id',
        'user_id',
    ];
    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function iotDevice()
    {
        return $this->belongsTo(IotDevice::class, 'scheme_id', 'scheme_id');
    }
}
