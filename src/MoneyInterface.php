<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money;

use Fes\Money\Currency\CurrencyInterface;

interface MoneyInterface
{
    /**
     * String representation of money
     *
     * @return string
     */
    public function __toString(): string;

    /**
     * @return float
     */
    public function getAmount(): float;

    /**
     * Money currency
     *
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface;
}
