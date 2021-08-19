<?php

namespace RigorTalks;

use InvalidArgumentException;

class CommandBus
{
    public function __construct(
        private array $handlers = [],
    ) {
    }

    public function addHandler(string $commandName, Object $handler): void
    {
        $this->handlers[$commandName] = $handler;
    }

    public function handle(Object $command)
    {
        $commandHandler = $this->handlers[get_class($command)];
        if ($commandHandler === null) {
            throw new InvalidArgumentException('Command not supported');
        }

        return $commandHandler->handle($command);
    }

    public function addDecorator(string $commandName, Object $handler): void
    {
    }
}

$commandBus = new CommandBus();
$commandBus->addHandler(PublishCommand::class, new PublishPost($postRepository));

// Inside a class
$commandBus->handle(new PublishCommand($userId, $postId));
