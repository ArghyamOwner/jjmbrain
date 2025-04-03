<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeFlowmeterDetails extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'value',
        'scheme_id',
        'created_by',
        'created_at'
    ];

    protected $casts = [
        'created_at' => 'date',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function flowmeterResetData()
    {
        return $this->hasOne(FlowmeterResetData::class, 'scheme_flowmeter_detail_id');
    }
}
