<?php

declare(strict_types=1);

namespace Common\Domain\Model\VO;

use Brick\Math\BigDecimal;

class Price
{
    /**
     * @var BigDecimal
     */
    private BigDecimal $amount;

    /**
     * @var Currency
     */
    private Currency $currency;

    /**
     * @param BigDecimal $amount
     * @param Currency $currency
     */
    public function __construct(BigDecimal $amount, Currency $currency)
    {
        $this->currency = $currency;
        $this->amount = $amount;
    }

    /**
     * @return BigDecimal
     */
    public function getAmount(): BigDecimal
    {
        return $this->amount;
    }

    /**
     * @return Currency
     */
    public function getCurrency(): Currency
    {
        return $this->currency;
    }
}
