<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ReviewSection extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'title',
        'points',
        'type',
        'photo'
    ];

    public function getPhotoUrlAttribute()
    {
        return $this->photo ? Storage::disk('uploads')->url($this->photo) : null;
    }

    public function reviewQuestions()
    {
        return $this->hasMany(ReviewQuestion::class);
    }

    public function userSchemeInspection()
    {
        // return $this->hasOne(SchemeInspection::class)->where('user_id', auth()->id());
        return $this->hasMany(SchemeInspection::class);
    }
}
