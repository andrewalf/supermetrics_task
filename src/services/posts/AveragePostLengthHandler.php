<?php

namespace App\Services\Posts;

use App\Entities\PostEntity;
use App\Services\StatisticsHandler;

class AveragePostLengthHandler implements StatisticsHandler
{
    protected array $sumOfPostLength = [];
    protected array $postsAmount = [];

    /**
     * Cant declare PostEntity type hint,
     * event if PostEntity implements Entity interface
     *
     * @param PostEntity $post
     */
    public function handle($post): void
    {
        $month = $post->getCreatedMonth();

        if (!array_key_exists($month, $this->sumOfPostLength)) {
            $this->sumOfPostLength[$month] = 0;
            $this->postsAmount[$month] = 0;
        }

        $this->sumOfPostLength[$month] += $post->messageLength();
        $this->postsAmount[$month] += 1;
    }

    public function getResult(): array
    {
        $data = [];

        foreach ($this->sumOfPostLength as $month => $sum) {
            $data[] = [
                'month' => $month,
                'length' => (int) round($sum / $this->postsAmount[$month]),
            ];
        }

        return [
            'averagePostLength' => $data
        ];
    }
}