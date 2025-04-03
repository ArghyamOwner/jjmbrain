<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubtaskReviewQuestion extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'subtask_id',
        'question',
        'description',
        'type',
        'options',
        'show_form',
        'meta',
    ];

    protected $casts = [
        'options' => 'array',
        'meta' => 'array',
        'show_form' => 'boolean',
    ];

    public function subtask()
    {
        return $this->belongsTo(Subtask::class);
    }
}
