<?php

namespace App\Repositories;

interface PostsRepository
{
    public function getAllPosts(): \Generator;
}