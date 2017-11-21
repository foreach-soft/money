<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Currency;

interface CurrencyInterface
{
    /**
     * Returns currency native use form after amount
     * example: for RUB 100 руб., for USD 100$ e.g.
     *
     * @return string
     */
    public function __toString(): string;
}
