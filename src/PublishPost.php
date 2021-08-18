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
        $post->publish();
    }
}
