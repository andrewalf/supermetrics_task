<?php

namespace App\Entities;

class PostEntity implements Entity
{
    public string $id;
    public string $fromName;
    public string $fromId;
    public string $message;
    public string $type;
    public \DateTime $createdTime;

    public function messageLength(): int
    {
        return strlen($this->message);
    }

    public function getCreatedMonth(): string
    {
        return $this->createdTime->format('m');
    }

    public function getCreatedWeek(): string
    {
        return $this->createdTime->format('W');
    }
}