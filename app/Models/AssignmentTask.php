<?php

namespace App\Models;

use App\Enums\AssignmentTaskStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AssignmentTask extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'scheme_id',
        'workorder_id',
        'task_id',
        'status',
        'progress',
        'instruction_read_at',
        'reviewed_by', 
        'tpa_progress', 
        'tpa_remark', 
        'meta',
        'last_notification_sent'
    ];

    protected $casts = [
        'status' => AssignmentTaskStatus::class,
        'instruction_read_at' => 'datetime',
        'last_notification_sent' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }

    public function assignmentSubtasks()
    {
        return $this->hasMany(AssignmentSubtask::class);
    }

    public function assignmentCompletedSubtasks()
    {
        return $this->hasMany(AssignmentSubtask::class)->whereNotNull('completed_at');
    }
}
