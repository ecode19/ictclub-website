<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\Rule;
use App\Models\Registration_number;
use RealRashid\SweetAlert\Facades\Alert;

class ValidRegistrationNumber implements Rule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    // public function validate(string $attribute, mixed $value, Closure $fail): void
    // {

    // }
    public function passes($attribute, $value)
    {
        // Query the database to check if the registration number exists
        return Registration_number::where('registration_number', $value)->exists();

        return redirect()->back();
        Alert::error('message', 'number exists');
    }

    public function message()
    {
        return 'The registration number does not exist in our records or is invalid.';
    }
}
