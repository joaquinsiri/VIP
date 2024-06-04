<?php

namespace VIP\Controller;

use VIP\Model\DataModel;
use VIP\Middleware\ValidationMiddleware;
use VIP\Service\ApiService;

class ApiController
{
    private ValidationMiddleware $validationMiddleware;
    private ApiService $apiService;

    public function __construct(ValidationMiddleware $validationMiddleware, ApiService $apiService)
    {
        $this->validationMiddleware = $validationMiddleware;
        $this->apiService = $apiService;
    }

    public function sendData(DataModel $data): void
    {
        try {
            if ($this->validationMiddleware->validateData($data)) {
                $response = $this->apiService->sendDataToApi($data);
                header('Content-Type: application/json');
                http_response_code(200);
                echo json_encode($response);
            } else {
                http_response_code(400);
                echo json_encode(["error" => "Validation failed!"]);
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode(["error" => $e->getMessage()]);
        }
    }
}
