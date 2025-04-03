<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum ESRStatus: string
{
    use EnumToArray;
        // fully compliant / partially compliant / non-compliant

    case FULLY_COMPLIANT = 'fully_compliant';
    case PARTIALLY_COMPLIANT = 'partially_compliant';
    case NON_COMPLIANT = 'non_compliant';

    public static function getEsrStatusOptions(): array
    {
        return array_map(fn(self $status) => [
            'value' => $status->value,
            'label' => ucfirst(str_replace('_', ' ', $status->value)),
        ], self::cases());
    } 
    
    public function color(): string
    {
        return  match ($this) {
            self::FULLY_COMPLIANT => 'green',
            self::PARTIALLY_COMPLIANT => 'yellow',
            self::NON_COMPLIANT => 'red',
        };
    }
}
