<?php

namespace App\Commands;

use App\Factories\PostsRepositoryFactory;

use App\Services\Posts\AverageNumberOfPostPerUserHandler;
use App\Services\Posts\AveragePostLengthHandler;
use App\Services\Posts\LongestPostHandler;
use App\Services\Posts\SplitPostsByWeekHandler;
use App\Services\StatisticsService;

class StatisticsCommand implements Command
{
    public function execute()
    {
        $service = new StatisticsService([
            new AveragePostLengthHandler,
            new LongestPostHandler,
            new SplitPostsByWeekHandler,
            new AverageNumberOfPostPerUserHandler,
        ]);

        $repository = PostsRepositoryFactory::getRepository();

        foreach ($repository->getAllPosts() as $post) {
            $service->handleEntity($post);
        }

        $filename = __DIR__.'/../../statistics.json';
        file_put_contents($filename, json_encode($service->getResult()));
        echo 'Statistics was written to file: '.realpath($filename).PHP_EOL;
    }
}