<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\CalculationRule\Purchase;


use Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem;
use Leonam\ShopChallenge\Bundle\Entity\Transaction\DividedPayment;

interface DividedPaymentCalculationRule
{
    public function calculateDividedPayment(PurchaseItem $purchaseItem) : DividedPayment;
}