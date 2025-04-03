<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssignmentSubtaskReview extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'assignment_subtask_id',
        'comment',
        'status',
        'user_type',
        'rating',
        'image',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
        'image' => 'array'
    ];

    protected $appends = [
        'images'
    ];

    public function assignmentSubtask()
    {
        return $this->belongsTo(AssignmentSubtask::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getImagesAttribute()
    {
        if ($this->meta) {
            return collect($this->meta)->map(function ($item) {
                return [
                    'id' => '',
                    'caption' => '',
                    'url' => Storage::disk('uploads')->url($item['path']) ?? '',
                    'size' => $item['size'],
                    'extension' => $item['extension'],
                ];
            })->all();
        } else {
            return [];
        }
    }
}
