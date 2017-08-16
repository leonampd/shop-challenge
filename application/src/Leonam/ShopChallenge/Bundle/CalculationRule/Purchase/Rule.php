<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\CalculationRule\Purchase;


interface Rule
{
    /**
     * @param \Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem[]
     *
     * @return float
     */
    public function calculate(array $items): float;
}