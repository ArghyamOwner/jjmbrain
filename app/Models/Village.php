<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Village extends Model
{
    use HasFactory;

    protected $fillable = [
        'village_name',
        'panchayat_id',
        'district_id'
    ];

    public function panchayat()
    {
        return $this->belongsTo(Panchayat::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function habitations()
    {
        return $this->hasMany(Habitation::class);
    }

    public function isas() {
        return $this->belongsToMany(Isa::class, 'isa_village', 'village_id', 'isa_id');
    }
}
