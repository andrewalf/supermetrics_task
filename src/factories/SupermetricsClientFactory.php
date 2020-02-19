<?php

namespace App\Factories;

use App\Api\SupermetricsClient;
use App\Exceptions\SupermaticsApiException;
use GuzzleHttp\Client;

class SupermetricsClientFactory
{
    public static function getClient(string $baseUrl): SupermetricsClient
    {
        if (empty($baseUrl)) {
            throw new SupermaticsApiException('Empty base url for api is not allowed');
        }

        $client = new Client([
            'base_uri' => $baseUrl,
            'timeout'  => 2.0,
        ]);

        return new SupermetricsClient($client);
    }
}