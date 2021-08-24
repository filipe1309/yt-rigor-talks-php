<?php

namespace RigorTalks;

use DateTimeImmutable;

class PostWasPublished
{
    private DateTimeImmutable $occurredOn;

    public function __construct(
        private string $userId,
        private string $postId,
    ) {
        $this->occurredOn = (new DateTimeImmutable())->getTimestamp();
    }

    public function occurredOn(): DateTimeImmutable
    {
        return $this->occurredOn;
    }

    public function userId(): string
    {
        return $this->userId;
    }

    public function postId(): string
    {
        return $this->postId;
    }
}
