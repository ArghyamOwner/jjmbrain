<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Banner extends Model
{
    use HasFactory;
    use HasUlids;

    const STATUS_ACTIVE = 'Active';
    const STATUS_INACTIVE = 'In-Active';

    protected $fillable = [
        'title',
        'app_name',
        'image',
        'link',
        'status',
        'created_by',
    ];

    public function scopeIsActive($query)
    {
        $query->where('status', self::STATUS_ACTIVE);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::disk('banner')->url($this->image) : null;
    }
}
