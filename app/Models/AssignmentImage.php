<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignmentImage extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'assignment_subtask_id',
        'path',
        'caption',
        'extension',
        'size',
    ];

    protected $appends = [
        'image_url'
    ];

    public function assignmentSubtask()
    {
        return $this->belongsTo(AssignmentSubtask::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->path ? Storage::disk('subtaskreports')->url($this->path) : null;
    }
}
