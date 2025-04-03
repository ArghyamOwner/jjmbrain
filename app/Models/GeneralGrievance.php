<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralGrievance extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'division_id',
        'district_id',
        'block_id',
        'scheme_id',
        'type',
        'reference_no',
        'description',
        'image',
        'status',
        'checked_by',
        'checked_on',
        'remarks',
        'created_by'
    ];

    protected $casts = [
        'checked_on' => 'datetime',
    ];

    public function division()
    {
        return $this->belongsTo(Division::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function checkedBy()
    {
        return $this->belongsTo(User::class, 'checked_by');
    }

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
