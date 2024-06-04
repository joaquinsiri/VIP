<?php

namespace VIP\Service;

use VIP\Model\DataModel;

class ApiService
{
    private string $apiKey;
    private string $databaseId;

    public function __construct(string $apiKey, string $databaseId)
    {
        $this->apiKey = $apiKey;
        $this->databaseId = $databaseId;
    }

    public function sendDataToApi(DataModel $data): array
    {
        $url = 'https://api.viprsp.nl/api/list_management_rows/ns';

        $payload = [
            'database_id' => $this->databaseId,
            'firstname' => $data->firstName,
            'lastname' => $data->lastName,
            'email' => $data->email,
            'dob' => $data->dateOfBirth,
            'phone' => $data->phoneNumber,
            'zip' => $data->zipCode,
            'opt_in' => 'true'
        ];

        $jsonPayload = json_encode($payload);

        $curl = curl_init();

        curl_setopt_array($curl, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $jsonPayload,
            CURLOPT_HTTPHEADER => [
                'Content-Type: application/json',
                'X-AUTH-TOKEN: ' . $this->apiKey
            ],
        ]);

        $response = curl_exec($curl);
        $httpStatusCode = curl_getinfo($curl, CURLINFO_HTTP_CODE);
        $err = curl_error($curl);

        curl_close($curl);

        if ($err) {
            error_log("cURL Error #: $err");
            throw new \Exception("cURL Error #:" . $err);
        } elseif ($httpStatusCode !== 200) {
            error_log("HTTP Status Code: $httpStatusCode. Response: $response");
            throw new \Exception("HTTP Status Code: $httpStatusCode. Response: $response");
        } else {
            return json_decode($response, true);
        }
    }
}
