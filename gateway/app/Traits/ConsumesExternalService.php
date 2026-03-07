<?php

namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService
{
    /**
     * Send a request to any service
     * @param string $method HTTP method (GET, POST, PUT, DELETE)
     * @param string $requestUrl The API endpoint
     * @param array $form_params Optional data to send
     * @param array $headers Optional headers
     * @return string Response body
     */
    public function performRequest($method, $requestUrl, $form_params = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        $response = $client->request($method, $requestUrl, [
            'form_params' => $form_params,
            'headers' => $headers
        ]);

        return $response->getBody()->getContents();
    }
}