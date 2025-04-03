<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'campaign_id',
        'question',
        'image',
        'option_1',
        'option_2',
        'option_3',
        'option_4',
        'correct_answer',
        'marks',
        'type',
    ];
}
