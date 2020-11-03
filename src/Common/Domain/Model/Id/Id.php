<?php

declare(strict_types=1);

namespace Common\Domain\Model\Id;

abstract class Id
{
    /**
     * @var string
     */
    private string $id;

    /**
     * @param string $id
     */
    public function __construct(string $id)
    {
        $this->id = $id;
    }

    public function __toString()
    {
        return $this->id;
    }
}
