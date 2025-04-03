<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionBfmStats extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'division_id',
        'stats_date',
        'schemes',
        'flowmeter_schemes',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
