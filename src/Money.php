<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money;

use Fes\Money\Currency\Currencies\Null;
use Fes\Money\Currency\CurrencyInterface;
use Fes\Money\Currency\HasStandardFormInterface;
use Fes\Money\Currency\NullCurrencyInterface;
use Fes\Money\Exception\DifferentCurrencyException;

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
     * @return Money
     */
    public static function null(): self
    {
        return new static(0, new Null());
    }
    
    /**
     * @return bool
     */
    public function isNull(): bool
    {
        return $this->amount == 0;
    }

    /**
     * @param Money $money
     * @return Money
     * @throws DifferentCurrencyException
     */
    public function add(self $money): self
    {
        if ($money->getCurrency() != $this->currency &&
            !$money instanceof NullCurrencyInterface &&
            !$this->currency instanceof NullCurrencyInterface
        ) {
            throw new DifferentCurrencyException();
        }

        return new static(
            $this->amount + $money->getAmount(),
            !$this->currency instanceof NullCurrencyInterface ? $this->currency : $money->currency
        );
    }

    /**
     * @param Money $money
     * @return Money
     * @throws DifferentCurrencyException
     */
    public function subtract(Money $money): Money
    {
        if ($money->getCurrency() != $this->currency &&
            !$money instanceof NullCurrencyInterface &&
            !$this->currency instanceof NullCurrencyInterface
        ) {
            throw new DifferentCurrencyException();
        }
    
        return new static(
            $this->amount - $money->getAmount(),
            !$this->currency instanceof NullCurrencyInterface ? $this->currency : $money->currency
        );
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        if ($this->currency instanceof HasStandardFormInterface) {
            return $this->currency->format($this);
        }
        
        if ($this->currency instanceof NullCurrencyInterface) {
            return (string) $this->amount;
        }
        
        return (string) $this->amount . (string) $this->currency;
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
