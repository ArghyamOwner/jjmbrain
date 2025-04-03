<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PerformanceGuaranteeType: string
{
    use EnumToArray;

    case Bank_Guarantee = "BG";
    // case FD = "FD";
    // case DR = "DR";
    // case DC = "DC";
    case Term_Deposit_Receipt = "TDR";
    case Fixed_Deposit_Receipt = "FDR";
    // case TDA = "TDA";
}
