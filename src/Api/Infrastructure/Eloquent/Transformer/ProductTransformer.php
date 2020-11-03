<?php

declare(strict_types=1);

namespace Api\Infrastructure\Eloquent\Transformer;

use Api\Domain\Model\ProductFactory;
use Api\Infrastructure\Eloquent\Model\Product as Entity;
use Api\Domain\Model\Product as Domain;
use Common\Domain\Model\Id\ProductId;

class ProductTransformer
{
    private ProductFactory $productFactory;

    /**
     * @param ProductFactory $productFactory
     */
    public function __construct(ProductFactory $productFactory)
    {
        $this->productFactory = $productFactory;
    }

    /**
     * @param Entity $entity
     * @return Domain
     */
    public function entityToDomain(Entity $entity): Domain
    {
        return $this->productFactory->createNew(
            new ProductId($entity->id),
            $entity->name,
            (float) $entity->price,
            $entity->currency
        );
    }

    /**
     * @param Domain $domain
     * @return Entity
     */
    public function domainToEntity(Domain $domain): Entity
    {
        $price = $domain->getPrice();

        $entity = new Entity();
        $entity->id = (string) $domain->getId();
        $entity->name = $domain->getName();
        $entity->price = $price->getAmount()->toFloat();
        $entity->currency = $price->getCurrency()->getName();

        return $entity;
    }
}
