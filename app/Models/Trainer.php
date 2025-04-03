<?php

namespace App\Models;

use App\Enums\TrainerOrganisation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Trainer extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'district_id',
        'trainer_name',
        'phone_number',
        'education_block_id',
        'bank_name',
        'account_number',
        'ifsc_code',
        'organisation',
        'trainer_type',
        'bank_document'
    ];

    protected $casts = [
        'organisation' => TrainerOrganisation::class
    ];

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function educationBlock()
    {
        return $this->belongsTo(EducationBlock::class);
    }

    public function jalshalaTrainerOnes()
    {
        return $this->hasMany(Jalshala::class, 'trainer_one_id');
    }

    public function jalshalaTrainerTwos()
    {
        return $this->hasMany(Jalshala::class, 'trainer_two_id');
    }
}
