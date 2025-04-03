<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class SchemePipeNetwork extends Model
{
    use HasFactory, HasUlids;

    const STATUS_ACCEPT = 'Accepted';
    const STATUS_REJECT = 'Rejected';
    const STATUS_PENDING = 'Pending';

    protected $fillable = [
        'scheme_id',
        'file',
        'status',
        'created_by',
        'verification_status',
        'verified_by',
        'verified_at',
        'comment',
    ];

    protected $casts = [
        'verified_at' => 'datetime',
    ];

    protected $appends = [
        'file_url',
    ];

    public function createdBy()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function verifiedBy()
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function getFileUrlAttribute()
    {
        return $this->file ? Storage::disk('canaltrackingGeoJson')->url($this->file) : null;
    }
}
