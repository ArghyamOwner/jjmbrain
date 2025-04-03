<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum WorkorderStatus: string
{
    use EnumToArray;
    
    case ONGOING = "ongoing";
    case COMPLETED = "completed";
    case DELETED_AT_SMT = 'deleted_smt';

    public function color(): string
    {
        return match($this) {
            self::ONGOING => 'info',   
            self::COMPLETED => 'success',
            self::DELETED_AT_SMT => 'warning',
        };
    }
}
