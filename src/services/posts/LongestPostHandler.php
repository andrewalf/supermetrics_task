<?php

namespace App\Services\Posts;

use App\Entities\PostEntity;
use App\Services\StatisticsHandler;

class LongestPostHandler implements StatisticsHandler
{
    /**
     * @var PostEntity[]
     */
    protected array $longestPosts = [];

    /**
     * Cant declare PostEntity type hint,
     * event if PostEntity implements Entity interface
     *
     * @param PostEntity $post
     */
    public function handle($post): void
    {
        $month = $post->getCreatedMonth();
        $monthIsEmpty = !array_key_exists($month, $this->longestPosts);

        if ($monthIsEmpty || $this->longestPosts[$month]->messageLength() < $post->messageLength()) {
            $this->longestPosts[$month] = $post;
        }
    }

    public function getResult(): array
    {
        $data = [];

        foreach ($this->longestPosts as $month => $post) {
            $data[] = [
                'month' => $month,
                'post' => $post
            ];
        }

        return [
            'longestPosts' => $data
        ];
    }
}