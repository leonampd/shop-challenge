<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity\Purchase;

use Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\Rule;
use Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\SimpleTotalCalculation;

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

    public function paymentShouldBeSplited(): bool
    {
        if (count($this->getSellers()) > 1) {
            return true;
        }
        return false;
    }
}