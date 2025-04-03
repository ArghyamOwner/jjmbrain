<?php

namespace App\Models;

use App\Enums\JalshalaStatus;
use App\Enums\JalshalaType;
use App\Traits\WithUniqueRandomNumberGenerator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Jalshala extends Model
{
    use HasFactory;
    use HasUlids;
    use WithUniqueRandomNumberGenerator;

    protected $fillable = [
        'user_id',
        'updated_by',
        'trainer_one_id',
        'trainer_two_id',
        'district_id',
        'block_id',
        'jalshala_uin',
        'venue',
        'day_one',
        'day_two',
        'status',
        'day_one_image',
        'day_two_image',
        'total_student_attended',
        'total_boys_attended',
        'total_girls_attended',
        'total_others_attended',
        'education_block_id',
        'type'
    ];

    protected $casts = [
        'day_one' => 'datetime',
        'day_two' => 'datetime',
        'status' => JalshalaStatus::class,
        'type' => JalshalaType::class
    ];

    protected $appends = [
        'attendance_link'
    ];

    // protected static function booted()
    // {
    //     static::created(function ($model) {
    //         $model->jalshala_uin = time() . mt_rand(100, 999);
    //         $model->save();
    //     });
    // }

    public function getDayOneImageUrlAttribute()
    {
        return ! is_null($this->day_one_image)
            ? Storage::disk('uploads')->url($this->day_one_image)
            : null;
    }

    public function getDayTwoImageUrlAttribute()
    {
        return ! is_null($this->day_two_image)
            ? Storage::disk('uploads')->url($this->day_two_image)
            : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class);
    }

    public function trainerOne()
    {
        return $this->belongsTo(Trainer::class, 'trainer_one_id');
    }

    public function trainerTwo()
    {
        return $this->belongsTo(Trainer::class, 'trainer_two_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    // public function educationBlock()
    // {
    //     return $this->belongsTo(EducationBlock::class);
    // }

    public function educationBlocks()
    {
        return $this->belongsToMany(EducationBlock::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function schemes()
    {
        return $this->belongsToMany(Scheme::class);
    }
 
    public function jalshalaSchools()
    {
        return $this->hasMany(JalshalaSchool::class);
    }

    public function jaldootAttendances()
    {
        return $this->hasMany(JaldootAttendance::class);
    }

    public function jalshalaSchoolsJaldoots()
    {
        return $this->hasManyThrough(Jaldoot::class, JalshalaSchool::class);
    }

    public function getAttendanceLinkAttribute()
    {
        return route('jalshalaSchoolStudent', $this->id);
    }
}
