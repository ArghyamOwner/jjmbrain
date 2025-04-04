<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum UserRole: string
{
    use EnumToArray;

    public static function toArray(): array 
    {
        return [];
    }
}
