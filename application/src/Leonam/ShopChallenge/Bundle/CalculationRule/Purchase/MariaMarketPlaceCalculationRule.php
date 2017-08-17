<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\CalculationRule\Purchase;


use Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem;

class MariaMarketPlaceCalculationRule implements Rule, DividedPaymentCalculationRule
{
    private const SHIPPING_TAX = 42;
    private const MARKETPLACE_OWNER_PERCENTAGE = 0.15;

    protected function calculateItemTotalPrice(PurchaseItem $item) : float
    {
        return self::SHIPPING_TAX + ($item->getProduct()->getValue() * $item->getQuantity());
    }

    public function calculate(array $items): float
    {
        $total = 0;
        foreach ($items as $item) {
            $total += $this->calculateItemTotalPrice($item);
        }
        return $total;
    }

    public function calculateDividedPayment(PurchaseItem $purchaseItem): DividedPayment
    {
        $itemTotalPrice = $this->calculateItemTotalPrice($purchaseItem);
        $ownerPart = $itemTotalPrice * self::MARKETPLACE_OWNER_PERCENTAGE;
        $partnerPart = $itemTotalPrice - $ownerPart;

        return new DividedPayment($purchaseItem, $itemTotalPrice, $ownerPart, $partnerPart);
    }

}