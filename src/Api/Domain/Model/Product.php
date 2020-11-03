<?php

declare(strict_types=1);

namespace Api\Domain\Model;

use Common\Domain\Model\AggregateRoot;
use Common\Domain\Model\Id\ProductId;
use Common\Domain\Model\VO\Price;

class Product extends AggregateRoot
{
    /**
     * @var ProductId
     */
    private ProductId $id;

    /**
     * @var string
     */
    private string $name;

    /**
     * @var Price
     */
    private Price $price;

    /**
     * @param ProductId $id
     * @param string $name
     * @param Price $price
     */
    public function __construct(ProductId $id, string $name, Price $price)
    {
        $this->id = $id;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * @return ProductId
     */
    public function getId(): ProductId
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Price
     */
    public function getPrice(): Price
    {
        return $this->price;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'id' => (string) $this->id,
            'name' => $this->name,
            'price' => (string) $this->price->getAmount(),
            'currency' => $this->price->getCurrency()->getName()
        ];
    }
}
