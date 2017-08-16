<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Entity\Purchase;

use Leonam\ShopChallenge\Bundle\Entity\Purchase\Purchase;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem;
use Leonam\ShopChallenge\Bundle\Entity\Seller;
use Leonam\ShopChallenge\Bundle\Entity\Product;
use Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\MariaMarketPlaceCalculationRule;
use PHPUnit\Framework\TestCase;

class PurchaseTest extends TestCase
{
    public function testIfAddPurchaseItemIncrementsListItems()
    {
        $seller = new Seller('seller 1');
        $product1 = new Product('product', 100, $seller);
        $purchaseItem = new PurchaseItem($product1,2);

        $purchase = new Purchase();
        $purchase->addItem($purchaseItem);

        $this->assertCount(1, $purchase->getItems());
    }

    /**
     * @covers \Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\SimpleTotalCalculation::calculate()
     * @covers \Leonam\ShopChallenge\Bundle\Entity\Purchase\Purchase::getTotal()
     */
    public function testIfNoRuleSettedTotalPurchaseShouldBySumOfItemPricesMultipliedByQuantity()
    {
        $seller = new Seller('seller 1');
        $product1 = new Product('product', 100, $seller);
        $purchaseItem = new PurchaseItem($product1,2);

        $purchase = new Purchase();
        $purchase->setItems([$purchaseItem]);

        $this->assertEquals(200, $purchase->getTotal());

        $product2 = clone $product1;
        $product2->setValue(250);
        $purchaseItem2 = new PurchaseItem($product2, 1);

        $purchase->addItem($purchaseItem2);

        $this->assertEquals(450, $purchase->getTotal());
    }

    /**
     * @covers \Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\MariaMarketPlaceCalculationRule::calculate()
     * @covers \Leonam\ShopChallenge\Bundle\Entity\Purchase\Purchase::getTotal()
     */
    public function testTotalPurchaseCalculationFromMariaMarketPlaceCalculationRule()
    {
        $purchase = new Purchase();
        $mariaMarketPlaceRule = new MariaMarketPlaceCalculationRule();
        $purchase->setTotalCalculationRule($mariaMarketPlaceRule);

        $seller = new Seller('Maria', Seller::MARKETPLACE_OWNER);

        $product1 = new Product('product', 125, $seller);
        $purchaseItem = new PurchaseItem($product1,1);
        $purchase->setItems([$purchaseItem]);

        $this->assertEquals(167, $purchase->getTotal());

        $product2 = clone $product1;
        $product2->setValue(100);
        $purchaseItem2 = new PurchaseItem($product2, 1);

        $purchase->addItem($purchaseItem2);

        $this->assertEquals(309, $purchase->getTotal());
    }

    public function testIfThePaymentShouldBeDividedForDifferentSellers()
    {
        $seller1 = new Seller('seller 1');
        $seller1->setRecipientId('123');

        $product1 = new Product('product', 125, $seller1);
        $purchaseItem = new PurchaseItem($product1,1);

        $product2 = new Product('product 2', 125, $seller1);
        $purchaseItem2 = new PurchaseItem($product2,1);

        $purchase = new Purchase();
        $purchase->setItems([$purchaseItem, $purchaseItem2]);

        $this->assertFalse($purchase->paymentShouldBeSplited());

        $differentSeller = new Seller('a different seller');
        $differentSeller->setRecipientId('987');

        $purchaseItem3 = clone $purchaseItem;
        $purchaseItem3->getProduct()->setSeller( $differentSeller );

        $purchase->addItem($purchaseItem3);
        $this->assertTrue($purchase->paymentShouldBeSplited());
    }
}
