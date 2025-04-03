<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subtask extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'task_id',
        'subtask_name',
        'subtask_description',
        'subtask_estimated_time',
        'type',
        'options',
        'show_form',
    ];

    protected $casts = [
        'options' => 'array',
    ];

    protected static function booted()
    {
        static::saved(function($model) {
            $model->task()->update([
                'task_estimated_time' => static::where('task_id', $model->task_id)->sum('subtask_estimated_time')
            ]);
        });
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function subtaskReviewQuestions()
    {
        return $this->hasMany(SubtaskReviewQuestion::class);
    }
}
