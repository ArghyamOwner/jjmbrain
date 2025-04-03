<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Workdocument extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'workorder_id',
        'name',
        'path',
        'size',
        'extension'
    ];

    public function workorder()
    {
        return $this->belongsTo(Workorder::class);
    }

    public function getDocumentUrlAttribute()
    {
        return $this->path ? Storage::disk('workorderdocs')->url($this->path) : null;
    }
}
