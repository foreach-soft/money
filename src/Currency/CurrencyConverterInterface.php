<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Currency;

use Fes\Money\Exception\ConvertNotExchangeableCurrencyException;
use Fes\Money\Exception\CurrencyRateNotExistException;
use Fes\Money\MoneyInterface;

interface CurrencyConverterInterface
{
    /**
     * @param MoneyInterface $money
     * @return MoneyInterface
     * @throws ConvertNotExchangeableCurrencyException
     * @throws CurrencyRateNotExistException
     */
    public function convert(MoneyInterface $money) : MoneyInterface;
}
