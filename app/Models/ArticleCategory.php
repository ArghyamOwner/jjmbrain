<?php

namespace App\Models;

use App\Traits\HasSlug;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ArticleCategory extends Model
{
    use HasFactory;
    use HasUlids;
    use HasSlug;

    private static $slugFromColumn = 'name';

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'image',
    ];

    public function articles()
    {
        return $this->hasMany(Article::class, 'category_id');
    }
}
