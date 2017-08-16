<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity\Purchase;


use Leonam\ShopChallenge\Bundle\Entity\Product;

class PurchaseItem
{
    /**
     * @var \Leonam\ShopChallenge\Bundle\Entity\Product
     */
    protected $product;

    /**
     * @var int
     */
    protected $quantity;

    public function __construct(Product $product, $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
     * @return \Leonam\ShopChallenge\Bundle\Entity\Product
     */
    public function getProduct(): \Leonam\ShopChallenge\Bundle\Entity\Product
    {
        return $this->product;
    }

    /**
     * @return int
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }
}