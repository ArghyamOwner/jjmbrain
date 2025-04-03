<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    use HasUlids;
    use HasSlug;

    private static $slugFromColumn = 'title';

    protected $fillable = [
        'category_id',
        'title',
        'slug',
        'content',
        'image',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime'
    ];

    public function getStatusAttribute()
    {
        return !is_null($this->published_at)
            ? 'Published'
            : 'Unpublished';
    }

    public function getStatusColorAttribute()
    {
        return match($this->status) {
            'Published' => 'success',
            'Unpublished' => 'warning',
            default => 'warning'
        };
    }

    public function getSummaryAttribute()
    {
        $plainText = html_entity_decode(strip_tags($this->attributes['content'])); 
        return Str::limit($plainText, 200);
    }

    public function category()
    {
        return $this->belongsTo(ArticleCategory::class, 'category_id');
    }
}
