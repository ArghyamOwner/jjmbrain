<?php

namespace App\Models;

use App\Enums\JalkoshStatus;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class JalkoshLink extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'link_type',
        'external_link',
        'attachment',
        'status'
    ];

    protected $casts = [
        'status' => JalkoshStatus::class
    ];

    protected $appends = [
        'attachment_url'
    ];

    public function getAttachmentUrlAttribute()
    {
        return $this->attachment ? Storage::disk('uploads')->url($this->attachment) : null;
    }
}
