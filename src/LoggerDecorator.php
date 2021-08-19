<?php

namespace RigorTalks;

class LoggerDecorator
{
    public function __construct(
        private Object $commandHandler,
        private Object $monolog
    ) {
    }

    public function execute(PublishCommand $command)
    {
        $this->monolog->log(serialize($command));
        return $this->commandHandler->execute($command);
    }
}
