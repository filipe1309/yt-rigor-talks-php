<?php

namespace RigorTalks;

class Publish
{
    public function __construct(
        private Object $userRepository,
        private Object $postRepository
    ) {
    }

    public function execute(PublishCommand $command): void
    {
        $user = $this->userRepository->ofIdOrFail($command->userId());
        $post = $this->postRepository->ofIdOrFail($command->postId());

        $user->publish($post);
    }
}

// $applicationService = new Publish($userRepository, $postRepository);
// $applicationService->execute($userId, $postId);

// $applicationService = new Publish($userRepository, $postRepository);
// $applicationService->execute(new PublishCommand($userId, $postId));

$applicationService = new LoggerDecorator(new Publish($userRepository, $postRepository), new Monolog());
$applicationService->execute(new PublishCommand($userId, $postId));
