<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CanalTracking extends Model
{
    use HasFactory, HasUlids;

    const STATUS_PENDING = 'pending';

    protected $fillable = [
        'scheme_id',
        'type',
        'size',
        'quality',
        'geojson',
        'has_geojson',
        'status',
        'created_by',
        'approved_by',
        'approved_on',
        'color_code',
        'valve',
        'road_cross',
        'distance',
        'reference_no'
    ];

    protected $casts = [
        'geojson' => 'array',
        'road_cross' => 'array',
        'valve' => 'array',
        'approved_on' => 'datetime'
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approvedBy()
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
