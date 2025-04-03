<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum SchemeNature: string {

    use EnumToArray;

    case MINI_SCHEME = "mini_scheme";
    case NORMAL_SCHEME = "normal_scheme";

    public function color(): string
    {
        return match ($this) {
            self::MINI_SCHEME => 'warning',
            self::NORMAL_SCHEME => 'success',
            default => 'info',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::MINI_SCHEME => 'Mini Scheme',
            self::NORMAL_SCHEME => 'Normal Scheme',
            default => '-',
        };
    }
}
