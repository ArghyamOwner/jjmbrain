<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum NoticeType: string
{
    use EnumToArray;
    
    case URGENT = "urgent";
    case CIRCULAR = "circular";
    case NOTICE = "notice";
}
