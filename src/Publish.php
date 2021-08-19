<?php

namespace RigorTalks;

class Publish
{
    public function __construct(
        private Object $userRepository,
        private Object $postRepository
    ) {
    }

    public function execute($userId, $postId): void
    {
        $user = $this->userRepository->ofIdOrFail($userId);
        $post = $this->postRepository->ofIdOrFail($postId);
        $user->publish($post);
    }
}

$applicationService = new Publish($userRepository, $postRepository);
$applicationService->execute($userId, $postId);
