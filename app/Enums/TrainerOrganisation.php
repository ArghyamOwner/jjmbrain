<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum TrainerOrganisation: string
{
    use EnumToArray;
    
    case ASTEC = "astec";
    case SSA = "ssa";
    case PHED = "phed";
}
