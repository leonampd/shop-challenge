<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Tests\CalculationRule\Purchase;

use Leonam\ShopChallenge\Bundle\Entity\Product;
use Leonam\ShopChallenge\Bundle\Entity\Seller;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\Purchase;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem;
use Leonam\ShopChallenge\Bundle\Entity\Transaction\DividedPayment;
use Leonam\ShopChallenge\Bundle\CalculationRule\Purchase\MariaMarketPlaceCalculationRule;
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
        $mariaMarketPlaceRule = new MariaMarketPlaceCalculationRule();
        $purchase = new Purchase();
        $purchase->setTotalCalculationRule($mariaMarketPlaceRule);

        $seller = new Seller('Maria', Seller::MARKETPLACE_OWNER);

        $product1 = new Product('product', 125, $seller);
        $purchaseItem = new PurchaseItem($product1,1);
        $purchase->setItems([$purchaseItem]);

        $this->assertEquals(16700, $purchase->getTotal());

        $product2 = clone $product1;
        $product2->setValue(100);
        $purchaseItem2 = new PurchaseItem($product2, 1);

        $purchase->addItem($purchaseItem2);

        $this->assertEquals(30900, $purchase->getTotal());
    }

    public function providerScenariosToCalcDividedPayments()
    {
        $ownerSeller = new Seller('Partner 1');
        $partnerSeller = new Seller('Partner 2');

        $purchase = new Purchase();

        $product1 = new Product('product', 100, $ownerSeller);
        $product2 = new Product('product 2', 125, $partnerSeller);

        $purchaseItem1 = new PurchaseItem($product1, 1);
        $purchaseItem2 = new PurchaseItem($product2, 1);
        $purchase->setItems([
            new PurchaseItem($product1, 1),
            new PurchaseItem($product2, 1)
        ]);

        $dividedPaymentProduct1 = new DividedPayment($purchaseItem1, 10000, 1500, 12700);
        $dividedPaymentProduct2 = new DividedPayment($purchaseItem2, 12500, 1875, 14825);

        return [
            [$purchase, [$dividedPaymentProduct1, $dividedPaymentProduct2]]
        ];
    }

    /**
     * @dataProvider providerScenariosToCalcDividedPayments
     * @param \Leonam\ShopChallenge\Bundle\Entity\Purchase\Purchase $purchase
     * @param $dividedPayments
     */
    public function testDividedPaymentCalculation(Purchase $purchase, $dividedPayments)
    {
        $calc = new MariaMarketPlaceCalculationRule();
        foreach ($purchase->getItems() as $key => $item) {
            $this->assertEquals($dividedPayments[$key], $calc->calculateDividedPayment($item));
        }
    }
}
