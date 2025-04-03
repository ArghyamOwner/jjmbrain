<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Habitation extends Model
{
    use HasFactory;

	protected $fillable = [
		'habitation_name',
		'population',
		'village_id',
		'habitation_id',
	];

	public function village()
	{
		return $this->belongsTo(Village::class);
	}

	public function schemes()
    {
        return $this->belongsToMany(Scheme::class);
    }
}
