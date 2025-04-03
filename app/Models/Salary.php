<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'user_id',
        'month',
        'year',
        'received_date',
    ];

    protected $casts = [
        'received_date' => 'date'
    ];

    protected $appends = [
        'month_name'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getMonthNameAttribute()
    {
        return date('F', mktime(0, 0, 0, $this->month, 1));
    }
}
