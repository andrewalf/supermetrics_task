<?php

namespace App\Services;

use App\Entities\Entity;

interface StatisticsHandler
{
    public function handle(Entity $entity): void;
    public function getResult(): array;
}