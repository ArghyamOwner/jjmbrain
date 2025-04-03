<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JaldootAttendance extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'jalshala_id',
        'jaldoot_id',
        'attended_at',
    ];

    public function jaldoot()
    {
        return $this->belongsTo(Jaldoot::class);
    }

    public function jalshala()
    {
        return $this->belongsTo(Jalshala::class);
    }
}
