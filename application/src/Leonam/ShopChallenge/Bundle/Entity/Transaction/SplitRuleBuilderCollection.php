<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity\Transaction;

use Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\MariaMarketPlaceCalculationRule;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\Purchase;
use Leonam\ShopChallenge\Bundle\SDK;
use PagarMe\Sdk\PagarMe as PagarMeSDK;
use PagarMe\Sdk\SplitRule\SplitRule;
use PagarMe\Sdk\SplitRule\SplitRuleCollection as PagarMeSplitRuleCollection;

class SplitRuleBuilderCollection implements SplitRuleCollectionBuilderInterface
{
    /**
     * @var \Leonam\ShopChallenge\Bundle\Entity\Purchase\Purchase
     */
    protected $purchase;

    /**
     * @var PagarMeSplitRuleCollection
     */
    protected $splitRuleCollection;

    /**
     * @var \Leonam\ShopChallenge\Bundle\SDK
     */
    protected $sdk;

    /**
     * @var \PagarMe\Sdk\Recipient[];
     */
    protected $recipients;

    public function __construct(Purchase $purchase)
    {
        $this->purchase = $purchase;
        $this->purchase->setTotalCalculationRule(new MariaMarketPlaceCalculationRule());
        $this->splitRuleCollection = new PagarMeSplitRuleCollection();
        $this->sdk = new PagarMeSDK('ak_test_4mQrnMSk1dRIhj2uyV7bnL0MBc4r80');
    }

    public function setSDK(SDK $sdk)
    {
        $this->sdk = $sdk;
    }

    public function createSplitRules()
    {
        $payments = $this->purchase->getDividedPayments();
        $owner = new \stdClass();
        $owner->total = 0;
        foreach ($payments as $payment) {
            $recipient = $this->sdk->getRecipient($payment->getPurchaseItem()->getProduct()->getSeller()->getRecipientID());
            if ($payment->getPurchaseItem()->getProduct()->getSeller()->isMarketPlaceOwner()) {
                $owner->recipient = $recipient;
                $owner->total += ($payment->getOwnerPart() + $payment->getPartnerPart());
            } else {
                $owner->total += $payment->getOwnerPart();
                $this->splitRuleCollection[] = $this->sdk->splitRule()->monetaryRule(
                    $payment->getPartnerPart(),
                    $recipient,
                    true,
                    true,
                    true
                );
            }
        }

        $this->splitRuleCollection[] = $this->sdk->splitRule()->monetaryRule(
            $owner->total,
            $owner->recipient,
            true,
            true,
            true
        );
    }

    public function getSplitRuleCollection() : PagarMeSplitRuleCollection
    {
        return $this->splitRuleCollection;
    }
}