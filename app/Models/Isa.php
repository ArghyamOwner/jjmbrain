<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Isa extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable=[
        'name',
        'type',
        'reg_no',
        'contact_name',
        'contact_phone',
        'district_id',
        'block_id'
    ];

    public function wucs()
    {
        return $this->belongsToMany(Wuc::class);
    }

    public function villages()
    {
        return $this->belongsToMany(Village::class);
    }

    public function district()
    {
        return $this->belongsTo(District::class);
    }

    public function block()
    {
        return $this->belongsTo(Block::class);
    }

    public function activityDetails()
    {
        return $this->belongsToMany(ActivityDetail::class);
    }

    public function getVillageNamesAttribute()
    {
        return $this->villages()->exists() ? $this->villages()->pluck('village_name')->implode(', ') : null;
    }
}