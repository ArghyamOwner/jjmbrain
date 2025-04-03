<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum SchemeTypes: string
{
    use EnumToArray;
    
    case NEW_SCHEME = "New Scheme";
    case RETROFITTING_OF_ONGOING_SCHEME = "Retrofitting of Ongoing Scheme";
    case RETROFITTING_OF_COMPLETED_SCHEME = "Retrofitting of Completed Scheme";
    case FRESH_RETROFITTING = "Fresh Retrofitting";
}
