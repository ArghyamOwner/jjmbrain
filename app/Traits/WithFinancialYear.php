<?php

namespace App\Traits;

use Carbon\Carbon;

trait WithFinancialYear
{
    protected static function generateFinancialYear($format = null)
    {
        $date = Carbon::now();
        if (date_format($date, "m") >= 4) {
            $financialYear = (date_format($date, $format)) . '-' . (date_format($date, $format) + 1);
        } else {
            $financialYear = (date_format($date, $format) - 1) . '-' . date_format($date, $format);
        }
        return $financialYear;
    }

    protected static function financialYearStartDate()
    {
        $date = Carbon::now();
        if (date_format($date, "m") >= 4) {
            $startDate = date_format($date, 'Y') . "-04-01";
        } else {
            $startDate = (date_format($date, 'Y') - 1) . "-04-01";
        }
        return $startDate;
    }

    protected static function financialYearEndDate()
    {
        $date = Carbon::now();
        if (date_format($date, "m") >= 4) {
            $endDate = (date_format($date, 'Y') + 1) . "-03-31";
        } else {
            $endDate = date_format($date, 'Y') . "-03-31";
        }
        return $endDate;
    }
}
