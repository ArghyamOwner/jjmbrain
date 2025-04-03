<?php

namespace App\Models;

use App\Enums\NoticeType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Notice extends Model
{
    use HasFactory;
    use HasUlids;

    const STATUS_ARCHIVE = 'archive';
    const STATUS_ACTIVE = 'active';

    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'type',
        'role',
        'document',
        'meta'
    ];

    protected $casts = [
        'type' => NoticeType::class
    ];

    protected $appends = [
        'type_color',
        'notice_created_since',
        'document_url'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getTypeColorAttribute()
    {
        return match($this->type->value) {
            'notice' => 'success',
            'urgent' => 'danger',
            'circular' => 'warning',
        };
    }

    public function getNoticeCreatedSinceAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function getDocumentUrlAttribute()
    {
        return $this->document ? Storage::disk('uploads')->url($this->document) : null;
    }
}
