<?php

declare(strict_types=1);

namespace Api\Application\Command;

use Common\Application\Command\Command;
use Common\Domain\Model\Id\ProductId;

class CreateProduct implements Command
{
    /**
     * @var ProductId
     */
    private ProductId $productId;

    /**
     * @var string
     */
    private string $productName;

    /**
     * @var float
     */
    private float $productPrice;

    /**
     * @var string
     */
    private string $currencyName;

    /**
     * @param ProductId $productId
     * @param string $productName
     * @param float $productPrice
     * @param string $currencyName
     */
    public function __construct(ProductId $productId,
                                string $productName,
                                float $productPrice,
                                string $currencyName = 'PLN'
    ) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productPrice = $productPrice;
        $this->currencyName = $currencyName;
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @return float
     */
    public function getProductPrice(): float
    {
        return $this->productPrice;
    }

    /**
     * @return string
     */
    public function getCurrencyName(): string
    {
        return $this->currencyName;
    }

    /**
     * @return array
     */
    public function getContext(): array
    {
        return [
            'product_id' => (string) $this->productId,
            'product_name' => $this->productName,
            'product_price' => $this->productPrice,
            'currency_name' => $this->currencyName
        ];
    }
}
