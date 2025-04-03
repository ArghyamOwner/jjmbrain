<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MonthlyExpenditure extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'amount',
        'remarks',
        'expenditure_date',
        'image',
        'expenditure_category_id',
        'wuc_id',
        'created_by',
        'financial_year_id',
    ];


    protected $casts = [
        'expenditure_date' => 'date',
    ];

    public function expenditureCategory()
    {
        return $this->belongsTo(ExpenditureCategory::class);
    }

    public function wuc()
    {
        return $this->belongsTo(Wuc::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function financialYear()
    {
        return $this->belongsTo(FinancialYear::class);
    }
}
