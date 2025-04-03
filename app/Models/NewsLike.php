<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class NewsLike extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'ip',
        'user_agent',
    ];

    public function news(): BelongsTo
    {
        return $this->belongsTo(News::class, 'news_id');
    }

    public function scopeForNewsPost($query, News $news)
    {
        return $query->where('news_id', $news->id);
    }
}
