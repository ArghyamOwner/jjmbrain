<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinancialYear extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'year',
        'start_date',
        'end_date'
    ];

    protected $casts = [
        'start_date' => 'date', 
        'end_date' => 'date'
    ];

    public function getFinancialYearAttribute()
    {
        return $this->start_date->format('Y') . '-' . $this->end_date->format('Y');
    }
}
