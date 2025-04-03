<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'tenant_id', 
        'user_id',
        'logo',
        'contact_email',
        'contact_phone',
        'social_links',
        'metrics',
        'address',
        'working_hours',
        'meta_title',
        'meta_description',
        'latitude',
        'longitude'
    ];

    protected $casts = [
        'social_links' => 'array',
        'metrics' => 'array'
    ];

    protected $appends = [
        'logo_url'
    ];

    protected static function booted()
    {
        static::created(function () {
            Cache::forget("settings.admin");
        });

        static::updated(function () {
            Cache::forget("settings.admin");
        });
    }

    public function getLogoUrlAttribute()
    {
        return !is_null($this->logo)
            ? Storage::disk('public')->url($this->logo) 
            : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
