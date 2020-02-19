<?php

namespace App\Api;

use App\Exceptions\SupermetricsApiException;
use GuzzleHttp\Client;

class SupermetricsClient
{
    protected Client $client;

    function __construct(Client $client) {
        $this->client = $client;
    }

    public function getToken(string $clientId, string $email, string $name): string
    {
        $response = $this->client->post( 'register', [
            'form_params' => [
                'client_id' =>$clientId,
                'email' => $email,
                'name' => $name,
            ],
        ]);

        $content = json_decode($response->getBody()->getContents(), JSON_UNESCAPED_UNICODE);
        $token = $content['data']['sl_token'] ?? null;

        if (!$token) {
            throw new SupermetricsApiException('Empty token. Check API health status');
        }

        return $token;

    }

    public function getPosts(int $page = 1): iterable
    {
        $response = $this->client->get('posts', [
            'query' => [
                'sl_token' => env('API_TOKEN'),
                'page' => $page,
            ],
        ]);

        $content = json_decode($response->getBody()->getContents(), JSON_UNESCAPED_UNICODE);
        $posts = $content['data']['posts'] ?? null;

        if (!$posts) {
            throw new SupermetricsApiException('No posts found');
        }

        return $posts;
    }
}