<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class VoterIdRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if(! preg_match('/^([a-zA-Z]){3}([0-9]){7}?$/', $value)) {
            $fail('The :attribute is invalid');
        }
    }
}
