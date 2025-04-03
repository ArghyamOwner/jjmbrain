<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait WithUuid
{
    public function scopeUuid($query, $uuid)
    {
        return $query->where('uuid', $uuid);
    }

    public function scopeUuidIn($query, array $uuidList = [])
    {
        return $query->whereIn('uuid', $uuidList);
    }

    protected static function bootWithUuid()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid()->toString();
        });
    }
}
