<?php

declare(strict_types = 1);

namespace Infrastructure\Generator;

use Common\Domain\Model\Id\Id;
use Exception;
use Ramsey\Uuid\Uuid;

class UuidGenerator implements IdGenerator
{
    /**
     * {@inheritDoc}
     */
    public function generate(string $className): Id
    {
        if(!is_subclass_of($className, Id::class)) {
            throw new Exception();
        }
        return new $className((string) Uuid::uuid4());
    }
}
