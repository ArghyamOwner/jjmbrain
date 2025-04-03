<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Member extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'district_id',
        'member_name',
        'member_phone',
        'designation',
        'department',
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
