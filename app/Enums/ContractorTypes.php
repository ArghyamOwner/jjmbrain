<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ContractorTypes: string
{
    use EnumToArray;
    
    case CLASS_I = "I";
    case CLASS_II = "II";
    case CLASS_III = "III";
}