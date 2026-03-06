<?php

namespace App\Validator;

use App\Enum\CarrierEnum;

class InputValidator
{
    public function validate($input)
    {
        if (is_string($input) === false) {
            return false;
        }

        return CarrierEnum::supportedCarriers($input);
    }
}