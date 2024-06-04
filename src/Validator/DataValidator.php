<?php

namespace VIP\Validator;

enum ZipCode: string
{
    case ZIP_1234 = '1234';
    case ZIP_2345 = '2345';
    case ZIP_3456 = '3456';
    case ZIP_4567 = '4567';
    case ZIP_5678 = '5678';
}

enum EmailDomain: string
{
    case GMAIL = 'gmail.com';
    case HOTMAIL = 'hotmail.com';
    case LIVE = 'live.com';
}

class DataValidator
{
    public function isValidZipCode(string $zipCode): bool
    {
        return ZipCode::tryFrom($zipCode) !== null;
    }

    public function isValidEmail(string $email): bool
    {
        $domain = substr(strrchr($email, "@"), 1);
        return EmailDomain::tryFrom($domain) !== null;
    }

    public function isOverThirty(string $dateOfBirth): bool
    {
        $dob = new \DateTime($dateOfBirth);
        $now = new \DateTime();
        $interval = $now->diff($dob);
        return $interval->y >= 30;
    }
}
