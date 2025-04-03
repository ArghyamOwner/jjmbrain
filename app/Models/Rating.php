<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'scheme_id',
        'user_id',
        'rating',
        'ip_address'
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
