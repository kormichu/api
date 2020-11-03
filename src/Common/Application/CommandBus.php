<?php

declare(strict_types=1);

namespace Common\Application;

use Common\Application\Command\Command;
use Common\Application\Handler\Handler;
use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

class CommandBus
{
    /**
     * @var Handler[]
     */
    private array $handlers = [];

    /**
     * @var LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param LoggerInterface $logger
     */
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * @param string $commandName
     * @param Handler $handler
     */
    public function registerHandler(string $commandName, Handler $handler): void
    {
        $this->handlers[$commandName] = $handler;
    }

    /**
     * @param Command $command
     */
    public function handle(Command $command): void
    {
        $context = $command->getContext();
        $className = get_class($command);
        $context['class'] = $className;

        $this->logger->debug('Trying to handle command', $context);

        if(!isset($this->handlers[$className])) {
            throw new \Exception(); // TODO
        }

        /** @var Handler $handler */
        $handler = $this->handlers[$className];
        $handler->handle($command);

        $this->logger->debug('The command has been handled', $context);
    }
}
