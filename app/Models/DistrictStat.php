<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictStat extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'district_id',
        'key',
        'name',
        'value',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
