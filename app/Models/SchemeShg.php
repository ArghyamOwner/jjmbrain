<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeShg extends Model
{
    use HasFactory, HasUlids;

    protected $fillable = [
        'scheme_id',
        'shg_name',
        'contact_person_name',
        'contact_person_phone',
        'shg_id',
    ];

    public function scheme()
    {
        return $this->belongsTo(Scheme::class);
    }
}
