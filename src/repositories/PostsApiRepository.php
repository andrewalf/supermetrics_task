<?php

namespace App\Repositories;

use App\Api\SupermetricsClient;
use App\Entities\PostEntity;

class PostsApiRepository implements PostsRepository
{
    protected SupermetricsClient $client;

    function __construct(SupermetricsClient $client) {
        $this->client = $client;
    }

    public function getAllPosts(): \Generator
    {
        for ($i = 1; $i <= 10; $i++) {
            $rawPostsChunk = $this->client->getPosts($i);

            foreach ($rawPostsChunk as $rawPost) {
                $post = new PostEntity();
                $post->id = $rawPost['id'];
                $post->fromId = $rawPost['from_id'];
                $post->fromName = $rawPost['from_name'];
                $post->type = $rawPost['type'];
                $post->message = $rawPost['message'];
                $post->createdTime = $rawPost['created_time'];

                yield $post;
            }
        }
    }
}