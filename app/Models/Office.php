<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Office extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'name',
        'address',
        'phone',
        'type',
        'longitude',
        'latitude',
        'image',
        'meta',
    ];

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::disk('office')->url($this->image) : null;
    }
}
