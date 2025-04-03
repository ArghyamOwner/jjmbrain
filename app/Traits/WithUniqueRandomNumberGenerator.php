<?php

namespace App\Traits;

trait WithUniqueRandomNumberGenerator
{
    public function generateUniqueRandomNumber(string $prefix = null, $separator = '-')
    {
        $number = now()->timestamp . random_int(1000, 9999);
		
		return $prefix . implode($separator, [substr($number, 0, 4), substr($number, 4, 6), substr($number, 10, 4)]);
    }
}
