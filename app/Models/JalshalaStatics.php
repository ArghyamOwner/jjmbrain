<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JalshalaStatics extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'id',
        'conducted',
        'pending',
        'pwss_mapped',
        'school_mapped',
        'jaldoot_mapped',
        'jaldoot_participated',
        'type',
        'block_name',
        'district_id',
        'block_id',
    ]; 
}
