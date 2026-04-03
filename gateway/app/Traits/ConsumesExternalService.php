<?php
namespace App\Traits;

use GuzzleHttp\Client;

trait ConsumesExternalService
{
    public function performRequest($method, $requestUrl, $form_params = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        if (isset($this->secret)) {
            $headers['Authorization'] = $this->secret;
        }

        $options = ['headers' => $headers];

        if (!empty($form_params)) {
            $options['json'] = $form_params;
        }

        $response = $client->request($method, $requestUrl, $options);

        return $response->getBody()->getContents();
    }
}