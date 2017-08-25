<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Currency;

interface ExchangeableCurrencyInterface
{
    /**
     * Returns ISO 4217 currency code
     *
     * @return string
     */
    public function getCode(): string;
}
