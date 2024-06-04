<?php

require '../vendor/autoload.php';

use VIP\Controller\ApiController;
use VIP\Middleware\ValidationMiddleware;
use VIP\Service\ApiService;
use VIP\Validator\DataValidator;
use VIP\Model\DataModel;

$requestData = [
    'firstName' => 'Joaquin',
    'lastName' => 'Siri',
    'email' => 'joaquinsiri@gmail.com',
    'phoneNumber' => '1234567890',
    'dateOfBirth' => '1992-07-11T15:53:00.482Z',
    'zipCode' => '1234'
];

$dataModel = new DataModel(
    firstName: $requestData['firstName'],
    lastName: $requestData['lastName'],
    email: $requestData['email'],
    phoneNumber: $requestData['phoneNumber'],
    dateOfBirth: $requestData['dateOfBirth'],
    zipCode: $requestData['zipCode']
);

$validator = new DataValidator();
$validationMiddleware = new ValidationMiddleware($validator);
$apiService = new ApiService(apiKey: '8a9011e2ce504150d1de6f9a061227ce', databaseId: '7212');
$apiController = new ApiController(validationMiddleware: $validationMiddleware, apiService: $apiService);

$apiController->sendData($dataModel);
