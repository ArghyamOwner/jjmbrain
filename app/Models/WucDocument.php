<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class WucDocument extends Model
{
    use HasFactory, HasUlids;

    const TYPE_APPROVAL_DOCUMENT = 'approval_document';
    const TYPE_CONSTITUTION_DOCUMENT = 'constitution_document';

    protected $fillable = [
        'title',
        'wuc_id',
        'type',
        'document',
        'created_by',
    ];

    public function wuc()
    {
        return $this->belongsTo(Wuc::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getDocumentUrlAttribute()
    {
        return $this->document ? Storage::disk('uploads')->url($this->document) : null;
    }
}
