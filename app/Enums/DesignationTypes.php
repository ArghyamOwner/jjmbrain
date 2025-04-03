<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum DesignationTypes: string
{
    use EnumToArray;
    
    case SENIOR_GRADE = "Sr. Grade";
    case GRADE_I = "Grade I";
    case GRADE_II = "Grade II";
}
