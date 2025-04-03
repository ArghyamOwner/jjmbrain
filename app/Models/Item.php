<?php

namespace App\Models;

use App\Enums\ItemCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'category',
        'type',
        'item_name',
        'item_code',
        'item_image',
        'item_description',
        'nature_of_use',
        'hazard_level',
        'unit',
        'meta',
    ];

    protected $casts = [
        'category' => ItemCategory::class
    ];

    protected $appends = [
        'item_image_url'
    ];

    public function getItemImageUrlAttribute()
    {
        return $this->item_image ? Storage::disk('uploads')->url($this->item_image) : null;
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
