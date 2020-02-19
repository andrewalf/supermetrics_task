<?php

namespace App\Commands;

use App\Api\Factories\SupermetricsClientFactory;
use App\Exceptions\SupermaticsApiException;

class TokenCommand implements Command
{
    public function execute()
    {
        $id = env('CLIENT_ID');
        $email = env('CLIENT_EMAIL');
        $name = env('CLIENT_NAME');

        if (empty($id) || empty($email) || empty($name)) {
            throw new SupermaticsApiException('Invalid input. All params are required');
        }

        $client = SupermetricsClientFactory::getClient(env('API_BASE_URL'));
        $token = $client->getToken($id, $email, $name);
        echo 'Token: '.$token.PHP_EOL;
    }
}