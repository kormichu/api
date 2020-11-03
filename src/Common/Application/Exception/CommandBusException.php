<?php

declare(strict_types=1);

namespace Common\Application\Exception;

use Common\Application\Command\Command;
use Exception;
use Throwable;

class CommandBusException extends Exception
{
    public const CODE_UNSUPPORTED_COMMAND = 1;

    /**
     * @var Command
     */
    private Command $command;

    /**
     * @param Command $command
     * @param Throwable|null $previous
     * @return $this
     */
    public static function forUnsupportedCommand(Command $command, Throwable $previous = null): self
    {
        $exception = new static('Unsupported command "' . get_class($command) . '"', self::CODE_UNSUPPORTED_COMMAND, $previous);
        $exception->command = $command;

        return $exception;
    }

    /**
     * @return Command
     */
    public function getCommand(): Command
    {
        return $this->command;
    }
}
