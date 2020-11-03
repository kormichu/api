<?php

declare(strict_types=1);

namespace Common\Application\Command;

interface Command
{
    /**
     * @return array
     */
    public function getContext(): array;
}
