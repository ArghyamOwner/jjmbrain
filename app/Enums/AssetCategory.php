<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum AssetCategory: string
{
    use EnumToArray;
    
    case MOTOR = "motor";
    case PUMP = "pump";
    case OHR = "ohr";
    case UGR = "ugr";
    case ESR = "esr";
    case DTW = "dtw";
    case TRANSFORMER = "transformer";
    case CHLORINE_PUMP = "chlorine_pump";
    case CONTROL_PANEL = "control_panel";
    case BARGE = "barge";
    case COMPUTER = "computer";
    case PRINTER = "printer";
    case FURNITURE = "furniture";
    case BOUNDARY_WALL = "boundary_wall";
    case GATE = "gate";
}
