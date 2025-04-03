<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ReviewQuestion extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'review_section_id',
        'question',
        'marks',
        'order'
    ];

    protected static function booted()
    {
        // self::saved(function ($model) {
        //     $model->reviewSection()->update([
        //         'points' => $model->sum('marks')
        //     ]);
        // });
    }

    public function reviewSection()
    {
        return $this->belongsTo(ReviewSection::class);
    }

    public function options()
    {
        return $this->hasMany(ReviewQuestionOption::class, 'review_question_id')->orderBy('order');
    }
}
