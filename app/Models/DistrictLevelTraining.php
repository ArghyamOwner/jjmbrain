<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DistrictLevelTraining extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'district_id',
        'day_one',
        'day_two',
        'trainer_one_id',
        'trainer_two_id',
        'trainer_three_id',
        'total_participant',
        'day_one_image',
        'day_two_image',
        'status'
    ];

    protected $casts = [
        'day_one' => 'datetime',
        'day_two' => 'datetime',
    ];

    public function trainerOne()
    {
        return $this->belongsTo(Trainer::class, 'trainer_one_id');
    }

    public function trainerTwo()
    {
        return $this->belongsTo(Trainer::class, 'trainer_two_id');
    }

    public function trainerThree()
    {
        return $this->belongsTo(Trainer::class, 'trainer_three_id');
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }
}
