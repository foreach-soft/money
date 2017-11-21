<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Currency\Currencies;

use Fes\Money\Currency\CurrencyInterface;
use Fes\Money\Currency\CurrencyWithSymbolInterface;
use Fes\Money\Currency\ExchangeableCurrencyInterface;
use Fes\Money\Currency\HasNameInterface;
use Fes\Money\Currency\HasStandardFormInterface;
use Fes\Money\MoneyInterface;

class Eur implements CurrencyInterface, HasNameInterface, HasStandardFormInterface, ExchangeableCurrencyInterface, CurrencyWithSymbolInterface
{
    const STRING      = "\xE2\x82\xAC";
    const NAME        = "Euro";
    const NAME_PLURAL = "euros";
    const CODE        = "EUR";
    const SYMBOL      = "\xE2\x82\xAC";

    /**
     * @inheritDoc
     */
    public function format(MoneyInterface $money): string
    {
        return sprintf("%01.2f%s", $money->getAmount(), (string) $this);
    }

    /**
     * @inheritDoc
     */
    public function __toString(): string
    {
        return self::STRING;
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        return self::NAME;
    }

    /**
     * @inheritDoc
     */
    public function getPluralName(): string
    {
        return self::NAME_PLURAL;
    }

    /**
     * @inheritDoc
     */
    public function getCode(): string
    {
        return self::CODE;
    }

    /**
     * @inheritDoc
     */
    public function getSymbol(): string
    {
        return self::SYMBOL;
    }
}
