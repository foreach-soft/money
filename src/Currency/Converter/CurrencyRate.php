<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Currency\Converter;

use Fes\Money\Currency\CurrencyInterface;

class CurrencyRate implements CurrencyRateInterface
{
    /**
     * @var float
     */
    protected $rate;

    /**
     * @var string
     */
    protected $fromCurrency;

    /**
     * @var string
     */
    protected $toCurrency;

    /**
     * @var CurrencyRate
     */
    private $reverseRate;

    /**
     * CurrencyRate constructor.
     *
     * @param string $fromCurrency Class name
     * @param string $toCurrency   Class name
     * @param float  $rate
     */
    public function __construct(string $fromCurrency, string $toCurrency, float $rate)
    {
        $this->rate = $rate;
        $this->fromCurrency = $fromCurrency;
        $this->toCurrency = $toCurrency;
    }

    /**
     * @inheritDoc
     */
    public function isRateOf(CurrencyInterface $fromCurrency, CurrencyInterface $toCurrency): bool
    {
        return $fromCurrency instanceof $this->fromCurrency &&
            $toCurrency instanceof $this->toCurrency;
    }

    /**
     * @return CurrencyRate
     */
    public function reverse(): self
    {
        if ($this->reverseRate) {
            return $this->reverseRate;
        }

        return $this->reverseRate = new CurrencyRate($this->toCurrency, $this->fromCurrency, 1 / $this->rate);
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @return string
     */
    public function getFromCurrency(): string
    {
        return $this->fromCurrency;
    }

    /**
     * @return mixed
     */
    public function getToCurrency()
    {
        return $this->toCurrency;
    }
}
