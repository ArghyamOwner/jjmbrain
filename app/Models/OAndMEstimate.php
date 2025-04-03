<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OAndMEstimate extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'wuc_id',
        'financial_year_id',
        'manpower',
        'maintenance',
        'electricity',
        'chemical',
        'total_monthly_estimate',
    ];

    public function financialYear()
    {
        return $this->belongsTo(FinancialYear::class);
    }

    public function wuc()
    {
        return $this->belongsTo(Wuc::class);
    }


}
