<?php
    /**
     * @package PHP
     * @author Leonam Pereira Dias <leonam.pd@gmail.com>
     */

    namespace Leonam\ShopChallenge\Bundle\Model;

    use Leonam\ShopChallenge\Bundle\Entity\ProductRepository;
    use Leonam\ShopChallenge\Bundle\Persistance\JustForTestPersistance;


    class Cart
    {
        /**
         * @var Leonam\ShopChallenge\Bundle\Entity\Product[]
         */
        protected $products;

        public function getCartProducts()
        {
            $fakeDBAccessLayer = new JustForTestPersistance();
            $productRepository = new ProductRepository($fakeDBAccessLayer);

            return $productRepository->getAll();
        }
    }