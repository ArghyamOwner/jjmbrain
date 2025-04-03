<?php

namespace App\Rules;

use App\Models\Lithology;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class LithologMaxEndValueRule implements ValidationRule
{
    public function __construct(protected $id) {    
        
    }

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if($value <= 0)
        {
            $fail('The :attribute must not be grater than 0');
        }
        
        $maxValue = Lithology::where('litholog_id', $this->id)->max('end');

        if($maxValue < $value)
        {
            $fail('The :attribute must not be grater than lithology max value');
        }
    }
}
