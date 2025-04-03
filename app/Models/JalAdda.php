<?php

namespace App\Models;

use App\Enums\JalshalaType;
use App\Enums\JaladdaStatus;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class JalAdda extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'day_one',
        'trainer_one_id',
        'trainer_two_id',
        'district_id',
        'venue',
        'status',
        'one_image',
        'two_image',
        'user_id',
        'attendee',
        'type'
    ];

    protected $casts = [
        'day_one' => 'datetime',
        'status' => JaladdaStatus::class,
        'type' => JalshalaType::class
    ];

    public function getDayOneImageUrlAttribute()
    {
        return ! is_null($this->one_image)
            ? Storage::disk('uploads')->url($this->one_image)
            : null;
    }

    public function getDayTwoImageUrlAttribute()
    {
        return ! is_null($this->two_image)
            ? Storage::disk('uploads')->url($this->two_image)
            : null;
    }

    public function user()
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

    public function jaladdaStudents()
    {
        return $this->hasMany(JalAddaStudent::class);
    }
}
