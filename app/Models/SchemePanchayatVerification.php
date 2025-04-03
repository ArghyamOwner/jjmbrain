<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemePanchayatVerification extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'scheme_id',
        'verified_at',
        'verified_by',
        'rejected_on',
        'rejected_by'
    ];

    protected $casts = [
        'verified_at' => 'datetime',
        'rejected_on' => 'datetime',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function rejectedBy()
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }
}
