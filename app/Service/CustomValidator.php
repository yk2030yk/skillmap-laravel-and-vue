<?php

namespace App\Service;

use Illuminate\Validation\Validator;

class CustomValidator extends Validator
{
    public function validateMemberId($attribute, $value, $parameters) {
        return (preg_match("/^[0-9]{6}$/", $value));
    }
}
