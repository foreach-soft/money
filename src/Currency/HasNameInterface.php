<?php
/**
 * @author      Kakhramonov Javlonbek <kakjavlon@gmail.com>
 * @copyright   2017 Foreach.Soft Ltd. (http://each.uz)
 */
declare(strict_types=1);

namespace Fes\Money\Currency;

interface HasNameInterface
{
    /**
     * @return string
     */
    public function getName(): string;
    
    /**
     * @return string
     */
    public function getPluralName(): string;
}
