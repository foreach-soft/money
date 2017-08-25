<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Currency\Converter;

use Fes\Money\Currency\CurrencyInterface;

interface CurrencyRateInterface
{
    /**
     * @param CurrencyInterface $fromCurrency
     * @param CurrencyInterface $toCurrency
     * @return bool
     */
    public function isRateOf(CurrencyInterface $fromCurrency, CurrencyInterface $toCurrency): bool;

    /**
     * Convert rate
     *
     * @return float
     */
    public function getRate(): float;
}
