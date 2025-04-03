<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Circle extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'zone_id',
        'name',
        'old_circle_id'
    ];

    public function zone()
    {
        return $this->belongsTo(Zone::class);
    }

    public function divisions()
    {
        return $this->hasMany(Division::class);
    }

    public function grievances()
    {
        return $this->morphMany(Grievance::class, 'grievancable');
    }
}
