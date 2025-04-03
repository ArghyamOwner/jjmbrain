<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum SchemeWaterSource: string
{
    use EnumToArray;

	case DTW = "DTW";
    case River = "River";
    case Pond = "Pond";
    case Spring = "Spring";
    case Ringwell = "Ringwell";

    // public function color(): string
    // {
    //     return match($this) {
    //         self::ONGOING => 'info',   
    //         self::COMPLETED => 'success',
    //         self::NOT_STARTED => 'warning',
    //         self::HANDED_OVER => 'danger',
    //         default => 'info',   
    //     };
    // }

    // public function label(): string
    // {
    //     return match($this) {
    //         self::ONGOING => 'Ongoing',   
    //         self::COMPLETED => 'Completed',
    //         self::NOT_STARTED => 'Not Started',
    //         self::HANDED_OVER => 'Handed Over',
    //         default => 'Ongoing',    
    //     };
    // }
}