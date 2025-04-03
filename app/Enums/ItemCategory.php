<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ItemCategory: string
{
    use EnumToArray;
    
    case CHEMICAL = "Chemical";
    case INSTRUMENT = "Instrument";
    case APPARATUS = "Apparatus";
    case SAFETY_EQUIPMENTS = "Safety Equipments";
    case MISCELLANEOUS = "Miscellaneous";

    public function color(): string
    {
        return match($this) {
            self::CHEMICAL => 'success',   
            self::INSTRUMENT => 'info',
            self::APPARATUS => 'warning',
            self::MISCELLANEOUS => 'danger',
            self::SAFETY_EQUIPMENTS => 'info',
        };
    }
}
