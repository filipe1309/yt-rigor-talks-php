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

    private function getStatus(): string
    {
        return $this->status;
    }

    private function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function publish(): void
    {
        if ($this->getStatus() === Post::STATUS_PUBLISHED) {
            return;
        }

        $this->setStatus(Post::STATUS_PUBLISHED);
    }
}
