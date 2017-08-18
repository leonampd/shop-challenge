<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\CalculationRule\Purchase;

use Leonam\ShopChallenge\Bundle\CalculationRule\ConvertToCents;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem;
use Leonam\ShopChallenge\Bundle\Entity\Transaction\DividedPayment;

class MariaMarketPlaceCalculationRule implements Rule, DividedPaymentCalculationRule
{
    use ConvertToCents;

    private const SHIPPING_TAX = 42;
    private const MARKETPLACE_OWNER_PERCENTAGE = 0.15;

    public function calculate(array $items): float
    {
        $total = 0;
        foreach ($items as $item) {
            $total += self::SHIPPING_TAX + ($item->getProduct()->getValue() * $item->getQuantity());
        }
        return $this->convertToCents($total);
    }

    public function calculateDividedPayment(PurchaseItem $item): DividedPayment
    {
        $itemTotalPrice = $item->getProduct()->getValue() * $item->getQuantity();
        $ownerPart = self::SHIPPING_TAX + ($item->getProduct()->getValue() * $item->getQuantity());
        $partnerPart = 0;
        if (!$item->getProduct()->getSeller()->isMarketPlaceOwner()) {
            $ownerPart = $itemTotalPrice * self::MARKETPLACE_OWNER_PERCENTAGE;
            $partnerPart = ($itemTotalPrice - $ownerPart) + self::SHIPPING_TAX;
        }
        $itemTotalPrice = $this->convertToCents($itemTotalPrice);
        $ownerPart = $this->convertToCents($ownerPart);
        $partnerPart = $this->convertToCents($partnerPart);
        return new DividedPayment($item, $itemTotalPrice, $ownerPart, $partnerPart);
    }
}
