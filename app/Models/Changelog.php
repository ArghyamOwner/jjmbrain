<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Changelog extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'version',
        'content_html',
        'content_md',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];
}
