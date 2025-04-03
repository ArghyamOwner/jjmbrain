<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SchemeQrReport extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'scheme_id',
        'photo',
        'user_id',
        'latitude',
        'longitude',
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
}
