<?php

namespace App\Services\Posts;

use App\Entities\PostEntity;
use App\Services\StatisticsHandler;

class SplitPostsByWeekHandler implements StatisticsHandler
{
    /**
     * @var PostEntity[]
     */
    protected array $posts = [];

    /**
     * Cant declare PostEntity type hint,
     * event if PostEntity implements Entity interface
     *
     * @param PostEntity $post
     */
    public function handle($post): void
    {
        $week = $post->getCreatedWeek();

        if (!array_key_exists($week, $this->posts)) {
            $this->posts[$week] = [];
        }

        $this->posts[$week][] = $post;
    }

    public function getResult(): array
    {
        $data = [];

        foreach ($this->posts as $week => $posts) {
            $data[] = [
                'week' => $week,
                'posts' => $posts
            ];
        }

        return [
            'postsByWeek' => $data
        ];
    }
}