<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Survey extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'beneficiary_id',
        'campaign_id',
        'answer',
        'called_by',
        'user_id'
    ];

    protected $casts = [
        'answer' => 'array',
    ];

    public function calledBy()
    {
        return $this->belongsTo(User::class, 'called_by');
    }

    public function beneficiary()
    {
        return $this->belongsTo(Beneficiary::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function campaign()
    {
        return $this->belongsTo(Campaign::class);
    }
}
