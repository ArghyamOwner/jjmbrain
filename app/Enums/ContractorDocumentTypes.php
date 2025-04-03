<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ContractorDocumentTypes: string
{
    use EnumToArray;
    
    case PAN = "Pan";
    case GST = "Gst";
    case MACHINE_LIST = "Machine List";
    case AADHAAR = "Aadhaar";
    case TRADE_LICENSE = "Trade License";
    case LABOUR_LICENSE = "Labour License";

    public function label(): string
    {
        return match($this) {
            self::PAN => 'PAN',
            self::GST => 'GST',
            self::AADHAAR => 'Aadhaar',
            self::LABOUR_LICENSE => 'Labour License',
            self::TRADE_LICENSE => 'Trade License',
        };        
    }
}
