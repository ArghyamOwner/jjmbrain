<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EducationBlockJalshala extends Model
{
    use HasFactory, HasUlids; 

    protected $table = 'education_block_jalshala';
    
    protected $fillable = [
        'id',
        'education_block_id',
        'jalshala_id'
    ];

    public function jalshalas()
    {
        return $this->hasMany(Jalshala::class,'id');
    }
}
