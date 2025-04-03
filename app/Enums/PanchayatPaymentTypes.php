<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PanchayatPaymentTypes: string {

    case CHEMICAL = "Chemical";
    case ELECTRICITY_BILL = "Electricity_Bill";
    case JALMITRA_SALARY = "Jalmitra_Salary";
    case MAINTENANCE = "Maintenance";
    case OTHER = "Other";

    public function color(): string
    {
        return match ($this) {
            self::CHEMICAL => 'success',
            self::ELECTRICITY_BILL => 'warning',
            self::JALMITRA_SALARY => 'warning',
            self::JALMITRA_SALARY => 'danger',
            default => 'info',
        };
    }

    public function label(): string
    {
        return match ($this) {
            self::CHEMICAL => 'Chemical',
            self::ELECTRICITY_BILL => "Electricity_Bill",
            self::JALMITRA_SALARY => "Jalmitra_Salary",
            self::MAINTENANCE => "Maintenance",
            default => 'Other',
        };
    }
}
