<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class GrievanceImage extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'grievance_id',
        'path',
        'extension',
        'size',
    ];

    protected $appends = [
        'image_url'
    ];

    public function grievance()
    {
        return $this->belongsTo(Grievance::class);
    }

    public function getImageUrlAttribute()
    {
        return $this->path ? Storage::disk('uploads')->url($this->path) : null;
    }
}
