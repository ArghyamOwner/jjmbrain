<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WucVolunteer extends Model
{
    use HasFactory;
    use HasUlids;

    const YES = 1;
    const NO = 0;

    protected $fillable = [
        'wuc_id',
        'name',
        'phone',
        'email',
        'nature',
        'is_trained',
        'no_of_trainings',
        'training_days',
        'training_description',
    ];
}
