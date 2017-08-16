<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\CalculationRule\Purchase;


class MariaMarketPlaceCalculationRule implements Rule
{
    private const SHIPPING_TAX = 42;

    public function calculate(array $items): float
    {
        $total = 0;
        foreach ($items as $item) {
            $total += self::SHIPPING_TAX + ($item->getProduct()->getValue() * $item->getQuantity());
        }
        return $total;
    }

}