<?php

namespace App\Rules;

use Egulias\EmailValidator\EmailValidator;
use Egulias\EmailValidator\Validation\DNSCheckValidation;
use Illuminate\Contracts\Validation\Rule;

class ValidEmailDomain implements Rule
{
    public function passes($attribute, $value)
    {
        $validator = new EmailValidator();
        return $validator->isValid($value, new DNSCheckValidation());
    }

    public function message()
    {
        return 'The :attribute must be a valid email address with a valid domain.';
    }
}