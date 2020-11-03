<?php

declare(strict_types=1);

namespace Api\Domain\Model;

use Brick\Math\BigDecimal;
use Common\Application\Command\Factory;
use Common\Domain\Model\Id\ProductId;
use Common\Domain\Model\VO\Currency;
use Common\Domain\Model\VO\Price;

class ProductFactory implements Factory
{
    /**
     * @param ProductId $productId
     * @param string $productName
     * @param float $productPrice
     * @param string $currencyName
     * @return Product
     */
    public function createNew(ProductId $productId, string $productName, float $productPrice, string $currencyName): Product
    {
        return new Product(
            $productId,
            $productName,
            new Price(
                BigDecimal::of($productPrice),
                new Currency($currencyName)
            )
        );
    }
}
