<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity\Transaction;

use Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem;

class DividedPayment
{
    /**
     * @var \Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem
     */
    protected $purchaseItem;

    /**
     * @var float
     */
    protected $total;

    /**
     * @var float
     */
    protected $ownerPart;

    /**
     * @var float
     */
    protected $partnerPart;

    public function __construct(PurchaseItem $purchaseItem, $total, $ownerPart, $partnerPart)
    {
        $this->purchaseItem = $purchaseItem;
        $this->total = $total;
        $this->ownerPart = $ownerPart;
        $this->partnerPart = $partnerPart;
    }

    /**
     * @return \Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem
     */
    public function getPurchaseItem(): \Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem
    {
        return $this->purchaseItem;
    }

    /**
     * @return float
     */
    public function getTotal(): float
    {
        return $this->total;
    }

    /**
     * @return float
     */
    public function getOwnerPart(): float
    {
        return $this->ownerPart;
    }

    /**
     * @return float
     */
    public function getPartnerPart(): float
    {
        return $this->partnerPart;
    }
}
