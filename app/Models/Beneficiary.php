<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Beneficiary extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'scheme_id',
        'user_id',
        'beneficiary_name',
        'beneficiary_phone',
        'beneficiary_voter_number',
        'beneficiary_aadhaar',
        'beneficiary_photo',
        'fhtc_number',
        'imis_id',
        'address',
        'latitude',
        'longitude',
        'remarks',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getBeneficiaryPhotoUrlAttribute()
    {
        return $this->beneficiary_photo
            ? Storage::disk('beneficiaries')->url($this->beneficiary_photo)
            : 'https://avatars.dicebear.com/api/initials/'. urlencode(trim($this->beneficiary_name)) .'.svg?&width=64&height=64';
    }

    public function latestSurvey()
    {
        return $this->hasOne(Survey::class)->latestOfMany();
    }
}
