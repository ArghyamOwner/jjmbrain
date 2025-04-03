<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum JalshalaType: string
{
    use EnumToArray;
    
    case PHASE_I = "phase_I";
    case PHASE_II = "phase_II";
}
