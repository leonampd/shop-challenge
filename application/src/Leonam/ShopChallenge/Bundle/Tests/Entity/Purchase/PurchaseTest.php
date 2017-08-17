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

    public function testIfTheSellerIsTheMarketPlaceOwnerThePaymentShouldNotBeDivided()
    {
        $seller1 = new Seller('seller 1', Seller::MARKETPLACE_OWNER);
        $seller1->setRecipientId('123');

        $product1 = new Product('product', 125, $seller1);
        $purchaseItem = new PurchaseItem($product1,1);

        $product2 = new Product('product 2', 125, $seller1);
        $purchaseItem2 = new PurchaseItem($product2,1);

        $purchase = new Purchase();
        $purchase->setItems([$purchaseItem, $purchaseItem2]);

        $this->assertFalse($purchase->paymentShouldBeSplited());
    }

    public function testIfThePaymentShouldBeDividedForDifferentSellers()
    {
        $seller1 = new Seller('seller 1', Seller::MARKETPLACE_OWNER);
        $seller1->setRecipientId('123');

        $seller2 = clone $seller1;
        $seller2->setRecipientId('321');

        $product1 = new Product('product', 125, $seller1);
        $purchaseItem = new PurchaseItem($product1,1);

        $product2 = new Product('product 2', 125, $seller2);
        $purchaseItem2 = new PurchaseItem($product2,1);

        $purchase = new Purchase();
        $purchase->setItems([$purchaseItem, $purchaseItem2]);

        $this->assertTrue($purchase->paymentShouldBeSplited());
    }
}
