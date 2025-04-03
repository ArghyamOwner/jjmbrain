<?php

namespace App\Enums;

use App\Traits\EnumToArray;

enum PanchayatPaymentTypesCeoZp: string {
    case ELECTRICITY_BILL = "Electricity_Bill";
    case MAINTENANCE = "Maintenance";
    case JALMITRA_SALARY = "Jalmitra_Salary";
}
