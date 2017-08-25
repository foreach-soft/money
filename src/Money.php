<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money;

use Fes\Money\Currency\CurrencyInterface;
use Fes\Money\Currency\CurrencyWithSymbolInterface;
use Fes\Money\Exception\DifferentCurrencyException;
use Fes\Money\Exception\SubstractGreaterAmountException;

class Money implements MoneyInterface
{
    /**
     * @var float
     */
    protected $amount;

    /**
     * @var CurrencyInterface
     */
    protected $currency;

    /**
     * Money constructor.
     *
     * @param float             $amount
     * @param CurrencyInterface $currency
     */
    public function __construct(float $amount, CurrencyInterface $currency)
    {
        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @param Money $money
     * @throws DifferentCurrencyException
     */
    public function add(Money $money)
    {
        if ($money->getCurrency() != $this->currency) {
            throw new DifferentCurrencyException();
        }

        $this->amount += $money->getAmount();
    }

    /**
     * @param Money $money
     * @throws DifferentCurrencyException
     * @throws SubstractGreaterAmountException
     */
    public function subtract(Money $money)
    {
        if ($money->getCurrency() != $this->currency) {
            throw new DifferentCurrencyException();
        }

        if ($this->amount < $money->getAmount()) {
            throw new SubstractGreaterAmountException();
        }

        $this->amount -= $money->getAmount();
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->currency->format($this);
    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return CurrencyInterface
     */
    public function getCurrency(): CurrencyInterface
    {
        return $this->currency;
    }
}
