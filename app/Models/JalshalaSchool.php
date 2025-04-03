<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JalshalaSchool extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'jalshala_id',
        'school_name',
        'school_code',
        'teacher_name',
        'phone_number',
        'student_applied',
        'link',
        'blocked_at',
        'school_id'
    ];

    protected $appends = [
        'form_link'
    ];

    protected static function booted()
    {
        static::created(function ($model) {
            $model->link = Str::uuid();
            $model->save();
        });
    }

    public function getFormLinkAttribute()
    {
        return route('jalshalaSchoolApplicationForm', $this->id);
    }

    public function jaldoots()
    {
        return $this->hasMany(Jaldoot::class);
    }

    public function jalshala()
    {
        return $this->belongsTo(Jalshala::class);
    }

    public function school()
    {
        return $this->belongsTo(School::class);
    }
}
