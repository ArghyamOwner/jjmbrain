<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Panchayat extends Model
{
    use HasFactory;

	protected $fillable = [
		'panchayat_name',
	];

	public function villages()
    {
        return $this->hasMany(Village::class);
    }

    public function block() {
        return $this->belongsTo(Block::class);
    }
}
