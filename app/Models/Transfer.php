<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'transferred_by',
        'accepted_by',
        'source_lab_id',
        'destination_lab_id',
        'item_id',
        'quantity',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array'
    ];

    public function transferedBy()
    {
        return $this->belongsTo(User::class, 'transferred_by');
    }

    public function acceptedBy()
    {
        return $this->belongsTo(User::class, 'accepted_by');
    }

    public function sourceLab()
    {
        return $this->belongsTo(Lab::class, 'source_lab_id');
    }

    public function destinationLab()
    {
        return $this->belongsTo(Lab::class, 'destination_lab_id');
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function showAcceptButton()
    {
        return auth()->user()->labs()->where('lab_id', $this->destination_lab_id)->exists();
    }
}
