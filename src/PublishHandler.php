<?php

namespace RigorTalks;

class PublishHandler
{
    public function __construct(
        private Object $userRepository,
        private Object $postRepository
    ) {
    }

    public function handle(PublishCommand $command)
    {
        $user = $this->userRepository->ofIdOrFail($command->userId());
        $post = $this->postRepository->ofIdOrFail($command->postId());

        $post->publish($user);

        /**
         * More tasks
         * - Send emails to author
         * - Ann new post to ElasticSearch, so it can be searched
         */

        return $post;
    }
}
