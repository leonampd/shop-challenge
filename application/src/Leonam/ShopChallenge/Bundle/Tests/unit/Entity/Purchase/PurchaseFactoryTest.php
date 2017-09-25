<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Tests\Entity\Purchase;

use Leonam\ShopChallenge\Bundle\Entity\Product;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\Purchase;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseFactory;
use Leonam\ShopChallenge\Bundle\Entity\Purchase\PurchaseItem;
use Leonam\ShopChallenge\Bundle\Entity\Seller;
use Leonam\ShopChallenge\Bundle\Entity\Customer\Customer;
use PHPUnit\Framework\TestCase;

class PurchaseFactoryTest extends TestCase
{
    public function testIfCanCreatePurchaseFromCartData()
    {
        $factory = new PurchaseFactory();

        $seller1 = new Seller('Seller Owner', Seller::MARKETPLACE_OWNER);
        $seller1->setRecipientId('123980');

        $seller2 = new Seller('Seller');
        $seller2->setRecipientId('980');

        $purchaseItem1 = new PurchaseItem(
            new Product('teste', 100, $seller1),
            1
        );
        $purchaseItem2 = new PurchaseItem(
            new Product('teste 2', 120, $seller2),
            1
        );

        $customer = new Customer([]);
        $purchase = $factory->create($customer, [$purchaseItem1, $purchaseItem2]);
        $this->assertInstanceOf(Purchase::class, $purchase);
    }
}
