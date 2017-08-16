<?php
    /**
     * @package PHP
     * @author Leonam Pereira Dias <leonam.pd@gmail.com>
     */

    namespace Leonam\ShopChallenge\Bundle\Model;

    use Leonam\ShopChallenge\Bundle\Entity\CartRepository;
    use Leonam\ShopChallenge\Bundle\Persistance\JustForTestPersistance;


    class Cart
    {
        /**
         * @var CartItem
         */
        protected $items;

        public function getItems()
        {
            $fakeDBAccessLayer = new JustForTestPersistance();
            $cartRepository = new CartRepository($fakeDBAccessLayer);

            return $cartRepository->getAll();
        }
    }