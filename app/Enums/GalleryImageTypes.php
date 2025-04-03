<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum GalleryImageTypes: string
{
    use EnumToArray;
    
    case PUMP = "Pump";
    case CANAL = "Canal";
    case TRANSFORMER = "Transformer";
    case PUMP_AND_MOTORS = "Pump and Motors";
    case LT_ELECTRICAL_ACCESSORIES = "LT Electrical Accessories";
    case OTHER = "Other";
}
