<?php

namespace VIP\Model;

class DataModel
{
    public readonly string $firstName;
    public readonly string $lastName;
    public readonly string $email;
    public readonly string $phoneNumber;
    public readonly string $dateOfBirth;
    public readonly string $zipCode;

    public function __construct(
        string $firstName,
        string $lastName,
        string $email,
        string $phoneNumber,
        string $dateOfBirth,
        string $zipCode
    ) {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phoneNumber = $phoneNumber;
        $this->dateOfBirth = $dateOfBirth;
        $this->zipCode = $zipCode;
    }
}
