<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AssetType: string
{
    use EnumToArray;
    
    case MOVABLE = "movable";
    case IMMOVABLE = "immovable";
}
