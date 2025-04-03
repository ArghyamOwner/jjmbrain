<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Campaign extends Model
{
    use HasFactory, HasUlids;

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;

    protected $fillable = [
        'name',
        'status',
        'role'
    ];

    protected $appends = [
        'status_name',
    ];

    public static function getStatusOptions()
    {
        return [
            self::STATUS_ACTIVE => "<span class='text-green-700'>Active</span>",
            self::STATUS_INACTIVE => "<span class='text-red-700'>In-Active</span>",
        ];
    }

    public function getStatusNameAttribute()
    {
        $list = self::getStatusOptions();
        return isset($list[$this->status]) ? $list[$this->status] : 'Not Defined';
    }

    public function questions()
    {
        return $this->hasMany(Question::class);
    }

    public function surveys()
    {
        return $this->hasMany(Survey::class);
    }
}
