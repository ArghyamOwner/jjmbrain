<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Subdivision extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'zone_id',
        'division_id',
        'name'
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function schemes()
    {
        return $this->belongsToMany(Scheme::class);
    }
}
