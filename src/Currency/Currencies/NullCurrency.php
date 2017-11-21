<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Currency\Currencies;

use Fes\Money\Currency\CurrencyInterface;
use Fes\Money\Currency\NullCurrencyInterface;

final class NullCurrency implements CurrencyInterface, NullCurrencyInterface
{
    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return '';
    }
}
