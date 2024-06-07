<?php

namespace App\Rules;

use App\Models\Registration_number;
use Illuminate\Contracts\Validation\Rule;

class UniqueRegistrationNumber implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Check if the registration number matches the pattern T/DEG/YYYY/NNNN
        if (!preg_match('/^T\/DEG\/\d{4}\/\d{4}$/', $value)) {
            return false;
        }

        // Extract the year part and check if it is 2021 or later
        $parts = explode('/', $value);
        $year = (int)$parts[2];

        if ($year < 2021) {
            return false;
        }

        // Check if the registration number already exists in the database
        if (Registration_number::where('registration_number', $value)->exists()) {
            return false;
        }

        return true;
    }
    public function message()
    {
        return 'The registration number must follow the format T/DEG/YYYY/NNNN, the year must be 2021 or later, and it must not be already registered.';
    }
}
