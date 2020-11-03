<?php

declare(strict_types=1);

namespace Api\Infrastructure\Eloquent\Repository;

use Api\Domain\Model\Product as Domain;
use Api\Infrastructure\Eloquent\Model\Product as Entity;
use Api\Infrastructure\Eloquent\Transformer\ProductTransformer;
use Common\Domain\Model\Id\ProductId;
use Common\Infrastructure\Exception\AggregateNotFoundException;

class ProductRepository implements \Api\Domain\Model\ProductRepository
{
    private ProductTransformer $productTransformer;

    /**
     * @param ProductTransformer $productTransformer
     */
    public function __construct(ProductTransformer $productTransformer)
    {
        $this->productTransformer = $productTransformer;
    }

    /**
     * {@inheritDoc}
     */
    public function get(ProductId $productId): Domain
    {
        $entity = Entity::find((string) $productId);
        if($entity === null) {
            throw AggregateNotFoundException::forInvalidId($productId);
        }

        return $this->productTransformer->entityToDomain($entity);
    }

    /**
     * {@inheritDoc}
     */
    public function save(Domain $product): void
    {
        $entity = $this->productTransformer->domainToEntity($product);
        $entity->save();
    }
}
