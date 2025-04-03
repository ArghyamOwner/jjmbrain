<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeFund extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'scheme_id',
        'released_amount',
        'old_scheme_id'
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
