<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Znck\Eloquent\Traits\BelongsToThrough;

class Lithology extends Model
{
    use HasFactory;
    use HasUlids;
    use BelongsToThrough;

    protected $fillable = [
        'litholog_id',
        'pattern_id',
        'start',
        'end',
        'type',
        'remarks',
    ];

    public function litholog()
    {
        return $this->belongsTo(Litholog::class);
    }

    public function pattern()
    {
        return $this->belongsTo(Pattern::class);
    }

    public function scheme()
    {
        return $this->belongsToThrough(Scheme::class, Litholog::class);
    }
}
