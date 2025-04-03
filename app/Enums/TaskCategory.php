<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum TaskCategory: string
{
    use EnumToArray;
    
    case SERVICE = "service";
    case WORK = "work";
    case SUPPLY = "supply";

    public function getWorkType(): string
    {
        return match($this) {
            self::SERVICE => 10,
            self::WORK => 20,
            self::SUPPLY => 30
        };
    }

    public function color(): string
    {
        return match($this) {
            self::SERVICE => 'info',
            self::WORK => 'success',
            self::SUPPLY => 'warning'
        };
    }
}
