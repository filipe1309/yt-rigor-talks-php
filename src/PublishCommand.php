<?php

namespace RigorTalks;

class PublishCommand
{
    public function __construct(
        private string $userId,
        private string $postId
    ) {
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
