<?php

declare(strict_types = 1);

namespace Infrastructure\Generator;

use Common\Domain\Model\Id\Id;

interface IdGenerator
{
    /**
     * @param string $className
     * @return Id
     */
    public function generate(string $className): Id;
}
