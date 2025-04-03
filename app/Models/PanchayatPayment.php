<?php

namespace App\Models;

use App\Enums\PanchayatPaymentTypes;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PanchayatPayment extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'scheme_id',
        'panchayat_id',
        'wuc_id',
        'wuc_ack',
        'jalmitra_id',
        'amount_paid',
        'amount_for',
        'payment_date',
        'transaction_id',
        'created_by',
        'month',
        'year',
        'district_id',
        'payment_made_on'
    ];

    protected $casts = [
        'wuc_ack' => 'date',
        'payment_date' => 'date',
        'payment_made_on' => 'date',
        'amount_for' => PanchayatPaymentTypes::class,
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function panchayat()
    {
        return $this->belongsTo(Panchayat::class);
    }

    public function wuc()
    {
        return $this->belongsTo(Wuc::class);
    }

    public function jalmitra()
    {
        return $this->belongsTo(User::class, 'jalmitra_id');
    }
}
