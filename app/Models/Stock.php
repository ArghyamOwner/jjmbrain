<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'user_id',
        'item_id',
        'lab_id',
        'transfer_id',
        'manufacturing_date',
        'expiry_date',
        'quantity',
        'stock_flow',
        'stock_receipt',
        'meta',
        'minimum_quantity_alert'
    ];

    protected $casts = [
        'manufacturing_date' => 'date',
        'expiry_date' => 'date',
        'meta' => 'array'
    ];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }

    public function transfer()
    {
        return $this->belongsTo(Transfer::class);
    }

    public function lab()
    {
        return $this->belongsTo(Lab::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
