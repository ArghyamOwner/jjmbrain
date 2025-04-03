<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum JalkoshStatus: string
{
    use EnumToArray;
    
    case ACTIVE = "active";
    case INACTIVE = "in-active";

    public function color(): string
    {
        return match($this) {
            self::ACTIVE => 'success',   
            self::INACTIVE => 'danger',
        };
    }
}
