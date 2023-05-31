<?php

namespace App\Validators;

use Illuminate\Validation\Validator;

class PasswordMatchValidator extends Validator
{
    public function validatePasswordMatch($password, $confirmPassword)
    {
        return $password === $confirmPassword;
    }
}
