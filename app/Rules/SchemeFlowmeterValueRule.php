<?php
namespace App\Rules;

use App\Models\SchemeFlowmeterDetails;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class SchemeFlowmeterValueRule implements ValidationRule
{
    public function __construct(protected $id)
    {}
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        if ($value <= 0) {
            $fail('The :attribute must not be less than or equal to 0');
        }

        $resetValue = SchemeFlowmeterDetails::where('scheme_id', $this->id)->latest()->first();
        if ($resetValue->reset_point) {
            if (! ($value > 0 && $value <= 2000)) {
                $fail('The :attribute must be between 0 and 2000');
            }
        } else {
            $maxValue = SchemeFlowmeterDetails::where('scheme_id', $this->id)->latest()->first()?->value;
            if ($maxValue >= $value) {
                $fail('The :attribute must be grater than previous value - ' . $maxValue);
            }
        }

    }
}
