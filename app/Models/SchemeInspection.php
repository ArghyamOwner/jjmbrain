<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SchemeInspection extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'scheme_id',
        'review_section_id',
        'section_marks',
        'user_marks',
        'photo',
        'comment',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array'
    ];

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? Storage::disk('uploads')->url($this->photo) : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function reviewSection()
    {
        return $this->belongsTo(ReviewSection::class);
    }
}
