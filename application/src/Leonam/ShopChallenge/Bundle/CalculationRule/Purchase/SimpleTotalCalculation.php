<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\CalculationRule\Purchase;


class SimpleTotalCalculation implements Rule
{
    public function calculate(array $purchaseItems) : float
    {
        $total = 0;
        foreach ($purchaseItems  as $item) {
            $total += ($item->getProduct()->getValue() * $item->getQuantity());
        }

        return $total;
    }
}