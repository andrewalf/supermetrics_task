<?php

namespace App\Commands;

use App\Api\Factories\SupermetricsClientFactory;

class TokenCommand implements Command
{
    public function execute()
    {
        $client = SupermetricsClientFactory::getClient(env('API_BASE_URL'));
        $token = $client->getToken(env('CLIENT_ID'), env('CLIENT_EMAIL'), env('CLIENT_NAME'));
        echo 'Token: '.$token.PHP_EOL;
    }
}