<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money;

use Assert\Assertion;
use Fes\Money\Currency\CurrencyInterface;
use Fes\Money\Exception\DifferentCurrencyException;
use Fes\Money\Exception\SubtractGreaterAmountException;

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
        Assertion::greaterOrEqualThan($amount, 0);

        $this->amount = $amount;
        $this->currency = $currency;
    }

    /**
     * @param Money $money
     * @return Money
     * @throws DifferentCurrencyException
     */
    public function add(Money $money): Money
    {
        if ($money->getCurrency() != $this->currency) {
            throw new DifferentCurrencyException();
        }

        return new Money($this->amount + $money->getAmount(), $this->currency);
    }

    /**
     * @param Money $money
     * @return Money
     * @throws DifferentCurrencyException
     * @throws SubtractGreaterAmountException
     */
    public function subtract(Money $money): Money
    {
        if ($money->getCurrency() != $this->currency) {
            throw new DifferentCurrencyException();
        }

        if ($this->amount < $money->getAmount()) {
            throw new SubtractGreaterAmountException();
        }

        return new Money($this->amount - $money->getAmount(), $this->currency);
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
