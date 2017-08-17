<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity\Purchase;

use Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\MariaMarketPlaceCalculationRule;
use Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\Rule;
use Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\SimpleTotalCalculation;
use Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\DividedPaymentCalculationRule;

class Purchase
{
    /**
     * @var \Leonam\ShopChallenge\Bundle\Entity\Customer\Customer
     */
    protected $customer;

    /**
     * @var \Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem[]
     */
    protected $items;

    /**
     * @var \Leonam\ShopChallenge\Bundle\Entity\Seller[]
     */
    protected $sellers;

    /**
     * @var \Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\Rule;
     */
    protected $totalCalculationRule;

    /**
     * @var \Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\DividedPaymentCalculationRule;
     */
    protected $dividedPaymentCalculationRule;

    protected $dividedPayments;

    public function setItems(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return \Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function addItem(PurchaseItem $item) {
        $this->items[] = $item;
    }

    private function updateSellers()
    {
        foreach ($this->items as $item) {
            $this->sellers[ $item->getProduct()->getSeller()->getRecipientId() ] = $item->getProduct()->getSeller();
        }
    }

    public function getSellers()
    {
        $this->updateSellers();
        return $this->sellers;
    }

    /**
     * @param \Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\Rule $totalCalculationRule
     */
    public function setTotalCalculationRule(Rule $totalCalculationRule) {
        $this->totalCalculationRule = $totalCalculationRule;
    }

    public function getTotal(): float
    {
        if (null === $this->totalCalculationRule) {
            $this->totalCalculationRule = new SimpleTotalCalculation();
        }
        return $this->totalCalculationRule->calculate($this->getItems());
    }

    public function getOwnerPart()
    {
        if (!$this->paymentShouldBeSplited()) {
            return $this->getTotal();
        }

        if (null === $this->dividedPaymentCalculationRule) {
            $this->dividedPaymentCalculationRule = new MariaMarketPlaceCalculationRule();
        }

        $total = 0;
        foreach ($this->getItems() as $item) {
            $paymentPart = $this->dividedPaymentCalculationRule->calculateDividedPayment($item);
            $total += $paymentPart->getOwnerPart();
        }

        return $total;
    }

    /**
     * @return \Leonam\ShopChallenge\Bundle\Entity\Transaction\DividedPayment[]
     */
    public function getDividedPayments()
    {
        if (null === $this->dividedPaymentCalculationRule) {
            $this->dividedPaymentCalculationRule = new MariaMarketPlaceCalculationRule();
        }
        foreach ($this->getItems() as $item) {
            $this->dividedPayments[] = $this->dividedPaymentCalculationRule->calculateDividedPayment($item);
        }
        return $this->dividedPayments;
    }

    public function paymentShouldBeSplited(): bool
    {
        $sellers = $this->getSellers();
        if (count($sellers) == 1 && array_values($sellers)[0]->isMarketPlaceOwner()) {
            return false;
        }
        if (count($sellers) > 1) {
            return true;
        }
    }
}