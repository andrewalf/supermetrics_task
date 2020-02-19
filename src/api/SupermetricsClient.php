<?php

namespace App\Api;

use GuzzleHttp\Client;

class SupermetricsClient
{
    protected string $token;
    protected Client $client;

    function __construct(Client $client, string $token) {
        $this->client = $client;
        $this->token = $token;
    }

    public function getPosts(int $page = 1)
    {
//        $this->getClient()->get('posts', [
//            'sl_token' => '',
//            'page' => $page
//        ]);
    }
}