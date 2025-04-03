<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AssignmentTaskStatus: string
{
    use EnumToArray;
    
    case COMPLETED = "completed";
    case ONGOING = "ongoing";
    case NOT_STARTED = "not-started";

    public function color(): string
    {
        return match($this) {
            self::COMPLETED => 'success',   
            self::ONGOING => 'info',
            self::NOT_STARTED => 'warning',
        };
    }
}
