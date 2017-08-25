<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Currency\Converter;

use Assert\Assertion;
use Fes\Money\Currency\CurrencyConverterInterface;
use Fes\Money\Currency\CurrencyInterface;
use Fes\Money\Currency\ExchangeableCurrencyInterface;
use Fes\Money\Exception\ConvertNotExchangeableCurrencyException;
use Fes\Money\Exception\CurrencyRateNotExistException;
use Fes\Money\Money;
use Fes\Money\MoneyInterface;

class CurrencyConverter implements CurrencyConverterInterface
{
    /**
     * @var CurrencyInterface|ExchangeableCurrencyInterface
     */
    protected $resultCurrency;

    /**
     * @var CurrencyRateInterface[]
     */
    protected $rates;

    /**
     * CurrencyConverter constructor.
     *
     * @param CurrencyInterface       $resultCurrency
     * @param CurrencyRateInterface[] $rates
     */
    public function __construct(CurrencyInterface $resultCurrency, array $rates)
    {
        Assertion::allImplementsInterface($rates, CurrencyRateInterface::class);

        $this->resultCurrency = $resultCurrency;
        $this->rates = $rates;
    }

    /**
     * @inheritDoc
     */
    public function convert(MoneyInterface $money): MoneyInterface
    {
        $targetCurrency = $money->getCurrency();

        if (!$targetCurrency instanceof ExchangeableCurrencyInterface) {
            throw new ConvertNotExchangeableCurrencyException();
        }

        foreach ($this->rates as $rate) {
            if ($rate->isRateOf($targetCurrency, $this->resultCurrency)) {
                return new Money(
                    $rate->getRate() * $money->getAmount(),
                    $this->resultCurrency
                );
            }
        }

        throw CurrencyRateNotExistException::fromCurrencies(
            get_class($targetCurrency),
            get_class($this->resultCurrency)
        );
    }

    /**
     * @return CurrencyInterface|ExchangeableCurrencyInterface
     */
    public function getResultCurrency()
    {
        return $this->resultCurrency;
    }

    /**
     * @return CurrencyRateInterface[]
     */
    public function getRates(): array
    {
        return $this->rates;
    }
}
