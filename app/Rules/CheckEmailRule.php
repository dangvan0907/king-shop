<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class CheckEmailRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $check = substr($value, strpos($value, '@') + 1);
        $checks = [
            'deha-soft.com'
        ];
        return in_array($check, $checks);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return "The validation error email '@deha-soft.com'";
    }
}
