<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Currency;

use Fes\Money\MoneyInterface;

interface HasStandardFormInterface
{
    /**
     * @param MoneyInterface $money
     * @return string
     */
    public function format(MoneyInterface $money): string;
}
