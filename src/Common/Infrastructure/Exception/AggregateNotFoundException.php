<?php

declare(strict_types=1);

namespace Common\Infrastructure\Exception;

use Common\Domain\Model\Id\Id;
use Exception;
use Throwable;

class AggregateNotFoundException extends Exception
{
    public const CODE_INVALID_ID = 10;

    /**
     * @var Id|null
     */
    private ?Id $id;

    /**
     * @param Id $id
     * @param Throwable|null $previous
     * @return static
     */
    public static function forInvalidId(Id $id, Throwable $previous = null): self
    {
        $exception = new static('Aggregate identified by "' . (string) $id . '" does not exist', self::CODE_INVALID_ID, $previous);
        $exception->id = $id;

        return $exception;
    }

    /**
     * @return Id|null
     */
    public function getId(): ?Id
    {
        return $this->id;
    }
}
