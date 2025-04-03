<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DivisionStat extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'division_id',
        'key',
        'name',
        'value',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }
}
