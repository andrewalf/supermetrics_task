<?php

namespace App\Commands;

use App\Factories\PostsRepositoryFactory;
use App\Factories\SupermetricsClientFactory;
use App\Repositories\PostsApiRepository;

class StatisticsCommand implements Command
{
    public function execute()
    {
        $repository = PostsRepositoryFactory::getRepository();

        foreach ($repository->getAllPosts() as $post) {
            $posts[] = $post;
        }
    }
}