<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeDailyFlowmeter extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'scheme_id',
        'status',
        'image',
        'updated_by',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function updatedBy()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
