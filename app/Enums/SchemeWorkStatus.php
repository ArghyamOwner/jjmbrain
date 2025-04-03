<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum SchemeWorkStatus: string
{
    use EnumToArray;
   
	case ONGOING = "ongoing";
    case COMPLETED = "completed";
    case NOT_STARTED = "not-started";
    case HANDED_OVER = "handed-over";

    public function color(): string
    {
        return match($this) {
            self::ONGOING => 'info',   
            self::COMPLETED => 'warning',
            self::NOT_STARTED => 'danger',
            self::HANDED_OVER => 'success',
            default => 'info',   
        };
    }

    public function label(): string
    {
        return match($this) {
            self::ONGOING => 'Ongoing',   
            self::COMPLETED => 'Completed',
            self::NOT_STARTED => 'Not Started',
            self::HANDED_OVER => 'Handed Over',
            default => 'Ongoing',    
        };
    }
}