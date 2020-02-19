<?php

namespace App\Factories;

use App\Repositories\PostsApiRepository;
use App\Repositories\PostsRepository;

class PostsRepositoryFactory
{
    public static function getRepository(): PostsRepository
    {
        $client = SupermetricsClientFactory::getClient(env('API_BASE_URL'));
        return new PostsApiRepository($client);
    }
}