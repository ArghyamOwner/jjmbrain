<?php

namespace App\Models;

use App\Enums\GalleryImageTypes;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Gallery extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'scheme_id',
        'caption',
        'image',
        'type',
        'tag'
    ];

    protected $casts = [
        'type' => GalleryImageTypes::class
    ];

    protected $appends = [
        'image_url'
    ];

    protected static function booted()
    {
        self::created(function($model) {
            $model->schemeActivity()->create([
                'user_id' => auth()->id(),
                'scheme_id' => $model->scheme_id,
                'activity_type' => 'gallery_created',
                'content' => 'Gallery'
            ]);
        });

        self::updated(function($model) {
            $model->schemeActivity()->create([
                'user_id' => auth()->id(),
                'scheme_id' => $model->scheme_id,
                'activity_type' => 'gallery_updated',
                'content' => 'Gallery'
            ]);
        });

        self::deleted(function($model) {
            $model->schemeActivity()->create([
                'user_id' => auth()->id(),
                'scheme_id' => $model->scheme_id,
                'activity_type' => 'gallery_deleted',
                'content' => 'Gallery'
            ]);
        });
    }

    public function getImageUrlAttribute()
    {
        return $this->image ? Storage::disk('uploads')->url($this->image) : null;
    }

    public function schemeActivity()
    {
        return $this->morphOne(SchemeActivity::class, 'feedable');
    }

    public function creatorName()
    {
        return $this->user->name;
    }

    public function link()
    {
        return route('schemes.show', [$this->scheme_id, 'tab' => 'images']);
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
