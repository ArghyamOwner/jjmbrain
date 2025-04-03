<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Block extends Model
{
    use HasFactory;

    protected $fillable = [
        'district_id',
        'name',
        'slug'
    ];

    public function panchayats()
    {
        return $this->hasMany(Panchayat::class);
    }

    public function villages(): HasManyThrough
    {
        return $this->hasManyThrough(Village::class, Panchayat::class);
    }

    public function districts()
    {
        return $this->hasMany(District::class);
    }

    public function grievances()
    {
        return $this->hasMany(Grievance::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function schemes()
    {
        return $this->belongsToMany(Scheme::class);
    }

    public function district() {
        return $this->belongsTo(District::class);
    }
}
