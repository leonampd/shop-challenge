<?php
    /**
     * @package PHP
     * @author Leonam Pereira Dias <leonam.pd@gmail.com>
     */

    namespace Leonam\ShopChallenge\Bundle\Entity;

    use Leonam\ShopChallenge\Bundle\Model\CartItem;

    class CartRepository extends Repository
    {
        public function save()
        {
            // TODO: Implement save() method.
        }

        public function update()
        {
            // TODO: Implement update() method.
        }

        public function delete()
        {
            // TODO: Implement delete() method.
        }

        public function getCartItems(): array
        {
            $cartItems = [];
            $productRepository = new ProductRepository($this->persistance);
            $products = $productRepository->getAll();
            foreach ($products as $product) {
                $cartItem = new CartItem($product, 1);
                $cartItems[] = $cartItem;
            }

            return $cartItems;
        }

        public function getAll(): array
        {
            return $this->getCartItems();
        }

        public function getById($id): EntityBase
        {
            // TODO: Implement getById() method.
        }

    }