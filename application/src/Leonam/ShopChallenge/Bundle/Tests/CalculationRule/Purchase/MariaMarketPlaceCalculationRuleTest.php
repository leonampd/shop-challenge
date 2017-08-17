<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Tests\CalculationRule\Purchase;

use Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\MariaMarketPlaceCalculationRule;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\Purchase;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem;
use Leonam\ShopChallenge\Bundle\Entity\Seller;
use Leonam\ShopChallenge\Bundle\Entity\Product;
use PHPUnit\Framework\TestCase;

class MariaMarketPlaceCalculationRuleTest extends TestCase
{
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
}
