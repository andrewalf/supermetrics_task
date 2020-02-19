<?php

namespace App\Api\Factories;

use App\Api\SupermetricsClient;
use App\Exceptions\SupermaticsApiException;
use GuzzleHttp\Client;

class SupermetricsClientFactory
{
    public static function getClient(string $baseUrl): SupermetricsClient
    {
        $client = new Client([
            'base_uri' => $baseUrl,
            'timeout'  => 2.0,
        ]);

        return new SupermetricsClient($client, self::getToken($client));
    }

    // My first thought was to separate token receiving in another
    // console command and pass token as a param to index.php-command.
    // And also I can't use session in CLI-mode.
    // But lets simplify a little bit, and just receive token on every
    // request.
    protected static function getToken(Client $client): string
    {
        $response = $client->post( 'register', [
            'form_params' => [
                'client_id' => env('CLIENT_ID'),
                'email' => env('CLIENT_EMAIL'),
                'name' => env('CLIENT_NAME'),
            ]
        ]);

        $content = json_decode($response->getBody()->getContents(), JSON_UNESCAPED_UNICODE);
        $token = $content['data']['sl_token'] ?? null;

        if (!$token) {
            throw new SupermaticsApiException('Empty token. Check API health status');
        }

        return $token;
    }
}