<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ContractorEntityTypes: string
{
    use EnumToArray;
    
    case PROPRIETORSHIP = "Proprietorship";
    case PARTNERSHIP = "Partnership";
    case PRIVATE_LTD = "Private Ltd.";
    case LIMITED = "Ltd.";
    case LLP = "LLP";
}
