<?php

namespace App\Services\Posts;

use App\Entities\PostEntity;
use App\Exceptions\SupermetricsApiException;
use App\Services\StatisticsHandler;

class AverageNumberOfPostPerUserHandler implements StatisticsHandler
{
    protected array $sumOfPostsPerMonth = [];
    protected array $usersPerMonth = [];

    /**
     * Cant declare PostEntity type hint,
     * event if PostEntity implements Entity interface
     *
     * @param PostEntity $post
     * @throws SupermetricsApiException
     */
    public function handle($post): void
    {
        if (!$post instanceof PostEntity) {
            throw new SupermetricsApiException('Not PostEntity passed to posts handler');
        }

        $userId = $post->fromId;
        $month = $post->getCreatedMonth();

        if (!array_key_exists($month, $this->sumOfPostsPerMonth)) {
            $this->sumOfPostsPerMonth[$month] = 0;
            $this->usersPerMonth[$month] = [];
        }

        $this->sumOfPostsPerMonth[$month] += 1;
        $this->usersPerMonth[$month][] = $userId;
    }

    public function getResult(): array
    {
        $data = [];

        foreach ($this->sumOfPostsPerMonth as $month => $sum) {
            $usersAmountForMonth = sizeof(array_unique($this->usersPerMonth[$month]));

            $data[] = [
                'month' => $month,
                'numberOfPosts' => (int) round($sum / $usersAmountForMonth),
            ];
        }

        return [
            'averageNumberOfPostsPerUserAndMonth' => $data
        ];
    }
}