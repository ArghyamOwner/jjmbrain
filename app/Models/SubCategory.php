<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class SubCategory extends Model
{
    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'category_id',
    ];

    /**
     * Get all of the Issues for the SubCategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasManyThrough
     */
    public function grievances(): HasManyThrough
    {
        return $this->hasManyThrough(Grievance::class, Issue::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
