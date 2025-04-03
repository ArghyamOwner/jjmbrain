<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Comment extends Model
{
    use HasFactory;
    use HasUlids;

    const TYPE_GRIEVANCE = 'grievance';

    const STATUS_RESOLVED = 'resolved';
    const STATUS_UNRESOLVED = 'unresolved';

    protected $fillable = [
        'type',
        'body',
        'status',
        'attachment',
        'commented_by',
        'commentable_type',
        'commentable_id',
    ];

    protected $appends = [
        'attachment_url',
        'status_color',
    ];

    public static function getStatusOptions()
    {
        return [
            self::STATUS_RESOLVED => "Resolved",
            self::STATUS_UNRESOLVED => "Un-Resolved",
        ];
    }

    public function getAttachmentUrlAttribute()
    {
        return $this->attachment ? Storage::disk('comments')->url($this->attachment) : null;
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function commentedBy()
    {
        return $this->belongsTo(User::class, 'commented_by');
    }

    public function getStatusColorAttribute()
    {
        return [
            self::STATUS_RESOLVED => 'success',
            self::STATUS_UNRESOLVED => 'danger',
        ][$this->status];
    }
}
