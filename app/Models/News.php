<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class News extends Model
{
    use HasFactory;
    use HasUlids;
    use HasSlug;

    private static $slugFromColumn = 'title';

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'description',
        'image',
        'meta',
        'deactivated_at'
    ];

    protected $casts = [
        'deactivated_at' => 'datetime'
    ];

    protected $withCount = [
        'likes',
    ];

    protected $appends = [
        'news_status',
        'news_status_color',
        'news_created_since',
        'newsimage_url',
        // 'newsimage_small_url',
        // 'newsimage_big_url',
    ];

    // public function getNewsimageBigUrlAttribute()
    // {
    //     return $this->image
    //         ? Str::generateImageKitUrl('news/' . $this->image, ['width' => 600])
    //         :  Str::generateImageKitUrl('no-image/' . 'not-available.png', ['width' => 600]);
    // }

    // public function getNewsimageSmallUrlAttribute()
    // {
    //     return $this->image
    //         ? Str::generateImageKitUrl('news/' . $this->image, ['height' => 200, 'width' => 200])
    //         : Str::generateImageKitUrl('no-image/' . 'not-available.png', ['height' => 200, 'width' => 200]);
    // }

    public function getSummaryAttribute()
    {
        $plainText = html_entity_decode(strip_tags($this->attributes['description'])); 
        return Str::limit($plainText, 200);
    }

    public function getNewsStatusAttribute()
    {
        return is_null($this->deactivated_at) ? 'published' : 'unpublished';
    }

    public function getNewsStatusColorAttribute()
    {
        return match($this->news_status) {
            'published' => 'success',
            'unpublished' => 'danger',
        };
    }

    public function getNewsimageUrlAttribute()
    {
        return $this->image ? Storage::disk('uploads')->url($this->image) : url('img/placeholder-image.jpeg');
    }

    public function getNewsCreatedSinceAttribute()
    {
        return $this->created_at->diffForHumans();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function likes(): HasMany
    {
        return $this->hasMany(NewsLike::class);
    }

    public function isLiked(): bool
    {
        if (auth()->user()) {
            return auth()->user()->likes()->forNewsPost($this)->count();
        }

        return false;
    }

    public function removeLike(): bool
    {
        if (auth()->user()) {
            return auth()->user()->likes()->forNewsPost($this)->delete();
        }

        return false;
    }
}
