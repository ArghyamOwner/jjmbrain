<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum FieldTestKitBrand: string
{
    use EnumToArray;
    
    case OCTOPUS = "Octopus";
    case TRANSCHEM = "TransChem";
}
