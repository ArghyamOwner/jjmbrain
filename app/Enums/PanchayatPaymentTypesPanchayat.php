<?php

namespace App\Enums;

enum PanchayatPaymentTypesPanchayat: string {
    case CHEMICAL = "Chemical";
    case JALMITRA_SALARY = "Jalmitra_Salary";
    case ELECTRICITY_BILL = "Electricity_Bill";
    case MAINTENANCE = "Maintenance";
    case OTHER = "Other";
}
