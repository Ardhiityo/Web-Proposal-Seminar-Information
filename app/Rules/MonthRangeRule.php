<?php

namespace App\Rules;

use Closure;
use Illuminate\Support\Facades\Log;
use Illuminate\Contracts\Validation\ValidationRule;

class MonthRangeRule implements ValidationRule
{
    public function __construct(private $start_month, private $end_month) {}

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string, ?string=): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $months = ['january' => 1, 'february' => 2, 'march' => 3, 'april' => 4, 'may' => 5, 'june' => 6, 'july' => 7, 'august' => 8, 'september' => 9, 'october' => 10, 'november' => 11, 'december' => 12];

        $startMonth = $months[strtolower($this->start_month)];
        $endMonth = $months[strtolower($this->end_month)];

        if ($endMonth < $startMonth) {
            $fail('The end month must be greater than or equal to the start month.');
        }
    }
}
