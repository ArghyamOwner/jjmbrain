<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalAddaStudent extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'jal_adda_id',
        'school_id',
        'student_name',
        'student_phone',
        'gender',
        'age',
        'class',
        'jaldoot_uin'
    ];

    public function jaladda()
    {
        return $this->belongsTo(JalAdda::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
