<?php

namespace VIP\Middleware;

use VIP\Model\DataModel;
use VIP\Validator\DataValidator;

class ValidationMiddleware
{
    private DataValidator $validator;

    public function __construct(DataValidator $validator)
    {
        $this->validator = $validator;
    }

    public function validateData(DataModel $data): bool
    {
        $isValid = $this->validator->isValidZipCode($data->zipCode) &&
            $this->validator->isValidEmail($data->email) &&
            $this->validator->isOverThirty($data->dateOfBirth);

        if (!$isValid) {
            error_log("Validation failed for data: " . json_encode($data));
        }

        return $isValid;
    }
}
