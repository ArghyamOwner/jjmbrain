<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum JalshalaStatus: string
{
    use EnumToArray;
    
    case COMPLETED = "completed";
    case PENDING = "pending";

    public function color(): string
    {
        return match($this) {
            self::COMPLETED => 'success',   
            self::PENDING => 'info',
        };
    }
}
