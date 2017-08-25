<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   Copyright (c) 2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Exception;

class SubtractingBiggerAmountException extends Exception
{
    protected $message = "Can't subtract big amount from small amount.";
}
