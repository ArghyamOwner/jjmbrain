<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Zone extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'old_zone_id'
    ];

    public function circles()
    {
        return $this->hasMany(Circle::class);
    }

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }
}
