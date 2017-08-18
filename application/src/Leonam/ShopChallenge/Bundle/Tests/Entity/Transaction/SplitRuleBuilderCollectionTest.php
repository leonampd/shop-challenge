<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Tests\Entity\Transaction;

use Leonam\ShopChallenge\Bundle\Entity\Transaction\SplitRuleBuilderCollection;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\Purchase;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem;
use Leonam\ShopChallenge\Bundle\Entity\Seller;
use Leonam\ShopChallenge\Bundle\Entity\Product;
use Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\MariaMarketPlaceCalculationRule;
use Leonam\ShopChallenge\Bundle\Entity\Transaction\SplitRuleCollectionDirector;
use Leonam\ShopChallenge\Bundle\SDK;
use Leonam\ShopChallenge\Bundle\ShopChallengePagarmeSDK;
use PagarMe\Sdk\Recipient\Recipient;
use PagarMe\Sdk\Recipient\RecipientHandler;
use PagarMe\Sdk\SplitRule\SplitRuleCollection as PagarMeSplitRuleCollection;
use PHPUnit\Framework\TestCase;

class SplitRuleBuilderCollectionTest extends TestCase
{
    public function testIfOurSplitBuilderCanCreateAPagarmeSplitRuleCollectionFromAPurchase()
    {
        $purchase = new Purchase();
        $mariaMarketPlaceRule = new MariaMarketPlaceCalculationRule();
        $purchase->setTotalCalculationRule($mariaMarketPlaceRule);

        $seller = new Seller('Maria', Seller::MARKETPLACE_OWNER);
        $anotherSeller = new Seller('another seller');

        $product1 = new Product('product', 125, $seller);
        $product1->setId(1);
        $purchaseItem = new PurchaseItem($product1, 1);
        $purchase->setItems([$purchaseItem]);

        $this->assertEquals(16700, $purchase->getTotal());

        $product2 = clone $product1;
        $product2->setId(2);
        $product2->setValue(100);
        $product2->setSeller($anotherSeller);
        $purchaseItem2 = new PurchaseItem($product2, 1);

        $purchase->addItem($purchaseItem2);
        $this->assertEquals(30900, $purchase->getTotal());

        $splitRuleBuilder = new SplitRuleBuilderCollection($purchase);
        $builderDirector = new SplitRuleCollectionDirector;

        $recipientMock = $this->getMockBuilder(Recipient::class)->disableOriginalConstructor()->getMock();

        $sdkMock = $this->getMockBuilder(ShopChallengePagarmeSDK::class)
                        ->setMethods(['getRecipient'])
                        ->disableOriginalConstructor()
                        ->getMock();
        $sdkMock->method('getRecipient')
            ->willReturn($recipientMock);

        $splitRuleBuilder->setSDK($sdkMock);

        $collection = $builderDirector->build($splitRuleBuilder);

        $this->assertInstanceOf(PagarMeSplitRuleCollection::class, $collection);
        $this->assertCount(2, $collection);

        $totalSplitRules = 0;
        foreach ($collection as $splitRule) {
            $totalSplitRules += $splitRule->getAmount();
        }

        $this->assertEquals($totalSplitRules, $purchase->getTotal());
    }
}
