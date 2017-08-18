<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity\Transaction;

use PagarMe\Sdk\SplitRule\SplitRuleCollection;

class SplitRuleCollectionDirector
{
    public function build(SplitRuleCollectionBuilderInterface $builder) : SplitRuleCollection
    {
        $builder->createSplitRules();
        return $builder->getSplitRuleCollection();
    }
}
