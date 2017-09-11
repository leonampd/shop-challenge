<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity\Purchase;

use Leonam\ShopChallenge\Bundle\Entity\Customer\Customer;
use Leonam\ShopChallenge\Bundle\Entity\ProductRepository;
use Leonam\ShopChallenge\Bundle\Persistance\JustForTestPersistance;

class PurchaseFactory
{
    public function createFromIdsAndItsQuantities(
        Customer $customer,
        array $productsIds,
        array $productsQuantities
    ) {
    
        $purchaseItems = [];
        $productModel = new ProductRepository(new JustForTestPersistance());
        foreach ($productsIds as $pId) {
            $product = $productModel->getById($pId);
            $quantity = $productsQuantities[$product->getId()];
            if ((int)$quantity > 0) {
                $purchaseItems[] = new PurchaseItem($product, $quantity);
            }
        }

        $purchase = new Purchase($customer);
        $purchase->setItems($purchaseItems);

        return $purchase;
    }

    public function create(Customer $customer, array $purchaseItems): Purchase
    {
        $purchase = new Purchase($customer);
        $purchase->setItems($purchaseItems);

        return $purchase;
    }
}
