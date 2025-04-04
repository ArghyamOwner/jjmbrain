<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewQuestionOption extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'review_question_id',
        'option',
        'marks',
        'order'
    ];
}
