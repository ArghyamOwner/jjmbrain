<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Jaldoot extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'jalshala_school_id',
        'jaldoot_uin',
        'student_name',
        'student_phone',
        'gender',
        'age',
        'class',
        'scheme_id'
    ];

    public function jalshalaSchool()
    {
        return $this->belongsTo(JalshalaSchool::class);
    }

    public function latestJaldootAttendance()
    {
        return $this->hasOne(JaldootAttendance::class)->latestOfMany();
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
