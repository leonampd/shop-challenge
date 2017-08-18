<?php
    /**
     * @package PHP
     * @author Leonam Pereira Dias <leonam.pd@gmail.com>
     */

    namespace Leonam\ShopChallenge\Bundle\Model;

    use Leonam\ShopChallenge\Bundle\Entity\Product;

class CartItem
{
    /**
         * @var Product
         */
    protected $product;

    /**
         * @var int
         */
    protected $quantity;

    /**
         * CartItem constructor.
         * @param Product $product
         * @param int $quantity
         */
    public function __construct(Product $product, int $quantity)
    {
        $this->product = $product;
        $this->quantity = $quantity;
    }

    /**
         * @return Product
         */
    public function getProduct(): Product
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

    /**
         * @param int $quantity
         */
    public function setQuantity(int $quantity)
    {
        $this->quantity = $quantity;
    }
}
