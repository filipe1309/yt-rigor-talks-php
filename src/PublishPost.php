<?php

namespace RigorTalks;

class PublishPost
{
    public function __construct(
        private Object $postRepository
    ) {
    }

    public function handle($postId): void
    {
        $post = $this->postRepository->ofIdOrFail($postId);
        if ($post->getStatus() !== Post::STATUS_PUBLISHED) {
            $post->setStatus(Post::STATUS_PUBLISHED);
        }
    }
}
