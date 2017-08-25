<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Exception;

class CurrencyRateNotExistException extends Exception
{
    protected $message = "Currency rate not exist.";

    /**
     * @param string $from
     * @param string $to
     * @return CurrencyRateNotExistException
     */
    public static function fromCurrencies(string $from, string $to): self
    {
        return new static(sprintf("%s/%s currency rate not exist.", $from, $to));
    }
}
