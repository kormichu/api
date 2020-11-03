<?php

declare(strict_types=1);

namespace Common\Application;

use Common\Application\Command\Command;
use Common\Application\Exception\CommandBusException;
use Common\Application\Handler\Handler;
use Psr\Log\LoggerInterface;

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
     * @param array $handlers
     */
    public function __construct(LoggerInterface $logger, array $handlers = array())
    {
        $this->logger = $logger;

        /** @var Handler $handler */
        foreach($handlers as $handler) {
            foreach($handler->getSupportedCommands() as $commandName) {
                $this->registerHandler($commandName, $handler);
            }
        }
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
            throw CommandBusException::forUnsupportedCommand($command);
        }

        /** @var Handler $handler */
        $handler = $this->handlers[$className];
        $handler->handle($command);

        $this->logger->debug('The command has been handled', $context);
    }
}
