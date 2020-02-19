<?php

namespace App\Services;

use App\Entities\Entity;

class StatisticsService
{
    function __construct(array $handlers) {
        array_map([$this, 'addHandler'], $handlers);
    }

    /**
     * @var StatisticsHandler[]
     */
    protected array $handlers = [];

    public function addHandler(StatisticsHandler $handler): StatisticsService
    {
        if (!array_search($handler, $this->handlers)) {
            $this->handlers[] = $handler;
        }

        return $this;
    }

    public function handleEntity(Entity $entity): void
    {
        foreach ($this->handlers as $handler) {
            $handler->handle($entity);
        }
    }

    public function getResult(): array
    {
        $result = [];

        foreach ($this->handlers as $handler) {
            $result = array_merge($result, $handler->getResult());
        }

        return $result;
    }
}