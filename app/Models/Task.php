<?php

namespace App\Models;

use App\Enums\TaskCategory;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Task extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'category',
        'task_uin',
        'task_name',
        'task_description',
        'task_doc',
        'task_estimated_time',
        'activity_id',
    ];

    protected $casts = [
        'category' => TaskCategory::class,
    ];

    protected $appends = [
        'task_doc_url',
    ];

    protected static function booted()
    {
        static::creating(function ($model) {
            $model->task_uin = $model->category->getWorkType() . sprintf("%02d", self::count() + 1);
        });
    }

    public function getTaskDocUrlAttribute()
    {
        return $this->task_doc ? Storage::disk('uploads')->url($this->task_doc) : null;
    }

    public function subtasks()
    {
        return $this->hasMany(Subtask::class);
    }

    public function activity()
    {
        return $this->belongsTo(Activity::class);
    }

    public function assignmentTask()
    {
        return $this->hasMany(AssignmentTask::class);
    }
}
