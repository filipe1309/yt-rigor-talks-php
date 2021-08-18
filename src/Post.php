<?php

namespace RigorTalks;

class Post
{
    const STATUS_DRAFT = 'draft';
    const STATUS_PUBLISHED = 'published';

    public function __construct(
        private string $id,
        private string $title,
        private string $content,
        private string $status = self::STATUS_DRAFT
    ) {
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }
}
