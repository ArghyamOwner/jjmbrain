<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'status',
        'resolved_days'
    ];

    public function subCategories()
    {
        return $this->hasMany(SubCategory::class);
    }
}
