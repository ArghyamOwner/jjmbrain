<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    const TYPE_ACTIVITY = 'activity';
    const TYPE_TASK = 'task';

    use HasFactory;
    use HasUlids;

    protected $fillable = [
        'name',
        'slug',
        'type',
        'status',
    ];

    public function scopeTypeActivity($query)
    {
        $query->where('type', self::TYPE_ACTIVITY);
    }

    public function scopeTypeTask($query)
    {
        $query->where('type', self::TYPE_TASK);
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
}
