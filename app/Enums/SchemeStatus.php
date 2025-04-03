<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum SchemeStatus: string
{
    use EnumToArray;
    
    case ALLOTED = "Alloted";
    case ACTIVE = "Active";

    public function color(): string
    {
        return match($this) {
            self::ACTIVE => 'success',   
            self::ALLOTED => 'info',
        };
    }
}
