<?php

namespace RigorTalks;

class PublishHandler
{
    public function __construct(
        private Object $userRepository,
        private Object $postRepository,
        private Object $eventDispatcher,
    ) {
    }

    public function handle(PublishCommand $command)
    {
        $user = $this->userRepository->ofIdOrFail($command->userId());
        $post = $this->postRepository->ofIdOrFail($command->postId());

        $post->publish($user);

        $this->eventDispatcher->notify(new PostWasPublished($user->id(), $post->id()));

        /**
         * More tasks
         * - Send emails to author
         * - Add new post to ElasticSearch, so it can be searched
         */

        return $post;
    }
}
