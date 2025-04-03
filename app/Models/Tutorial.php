<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tutorial extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'actor',
        'caption',
        'instruction_link',
        'instruction_attachment',
        'meta',
    ];

    protected $appends = [
        'instruction_attachment_url',
    ];

     public function getInstructionAttachmentUrlAttribute()
    {
        return $this->instruction_attachment ? Storage::disk('uploads')->url($this->instruction_attachment) : null;
    }
}
