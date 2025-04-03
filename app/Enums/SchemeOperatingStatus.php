<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum SchemeOperatingStatus: string
{
    use EnumToArray;
    
    case OPERATIVE = "operative";
    case NON_OPERATIVE = "non-operative";
    case PARTIALLY_OPERATIVE = "partially-operative";
    
    public function color(): string
    {
        return match($this) {
            self::OPERATIVE => 'success',   
            self::NON_OPERATIVE => 'danger',
            self::PARTIALLY_OPERATIVE => 'warning',
            default => 'success',   
        };
    }

    public function label(): string
    {
        return match($this) {
            self::OPERATIVE => 'Operative',   
            self::NON_OPERATIVE => 'Non Operative',
            self::PARTIALLY_OPERATIVE => 'Partially Operative',
            default => 'N/A',
        };
    }
}