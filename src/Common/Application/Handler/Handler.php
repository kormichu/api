<?php

declare(strict_types=1);

namespace Common\Application\Handler;

use Common\Application\Command\Command;

interface Handler
{
    /**
     * @param Command $command
     */
    public function handle(Command $command): void;
}
