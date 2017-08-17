<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity\Transaction;


use Leonam\ShopChallenge\Bundle\Entity\Purchase\Purchase;

interface SplitRuleCollectionBuilderInterface
{
    public function __construct(Purchase $purchase);
    public function createSplitRules();
    public function getSplitRuleCollection();
}