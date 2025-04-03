<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'scheme_id',
        'title',
        'link',
        'description',
        'tags',
        'meta',
    ];

    // Tracks scheme activity
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
        return route('schemes.show', [$this->scheme_id, 'tab' => 'videos']);
    }
    // Tracks scheme activity

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
