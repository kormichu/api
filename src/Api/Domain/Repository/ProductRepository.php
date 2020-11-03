<?php

declare(strict_types=1);

namespace Api\Domain\Model;

use Common\Domain\Model\Id\ProductId;
use Common\Infrastructure\Exception\AggregateNotFoundException;

interface ProductRepository
{
    /**
     * @param ProductId $productId
     * @throws AggregateNotFoundException
     * @return Product
     */
    public function get(ProductId $productId): Product;

    /**
     * @param Product $product
     */
    public function save(Product $product): void;
}
