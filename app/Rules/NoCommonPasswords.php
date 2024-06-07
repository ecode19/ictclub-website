<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class NoCommonPasswords implements Rule
{
    protected $commonPasswords = [
        '123456', 'password', '123456789', '12345678', '12345', '1234567', '1234567890', 'mwecau', 'mwenge'
    ];

    public function passes($attribute, $value)
    {
        return !in_array($value, $this->commonPasswords);
    }

    public function message()
    {
        return 'The :attribute is too common. Please choose a more secure password.';
    }
}
