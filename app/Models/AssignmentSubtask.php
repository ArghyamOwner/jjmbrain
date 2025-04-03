<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentSubtask extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'assignment_task_id',
        'user_id',
        'workorder_id',
        'subtask_id',
        'remarks',
        'answer',
        'meta',
        'completed_at',
    ];

    protected $casts = [
        'completed_at' => 'datetime',
    ];

    protected static function booted()
    {
        static::updated(function($model) {
            $subtaskCompleted = $model->assignmentTask->assignmentCompletedSubtasks->count();
            $subtaskTotal = $model->assignmentTask->assignmentSubtasks->count();

            $progress = $subtaskCompleted /  $subtaskTotal * 100;

            $model->assignmentTask()->update([
                'progress' => $progress
            ]);

            if ($subtaskCompleted > 0) {
                $model->assignmentTask()->update([
                    'status' => 'ongoing'
                ]);
            }

            if ($subtaskCompleted == $subtaskTotal) {
                $model->assignmentTask()->update([
                    'status' => 'completed'
                ]);
            }
        });
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assignmentTask()
    {
        return $this->belongsTo(AssignmentTask::class);
    }

    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }

    public function subtask()
    {
        return $this->belongsTo(Subtask::class);
    }

    public function assignmentImages()
    {
        return $this->hasMany(AssignmentImage::class);
    }

    public function assignmentReviews()
    {
        return $this->hasMany(AssignmentSubtaskReview::class)->latest('id');
    }
}
