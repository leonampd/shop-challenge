<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Model;

use Leonam\ShopChallenge\Bundle\Entity\ProductRepository;
use Leonam\ShopChallenge\Bundle\Entity\Repository;
use Leonam\ShopChallenge\Bundle\Persistance\JustForTestPersistance;

class Product
{
    protected $repository;

    public function __construct(Repository $repository = null)
    {
        $this->repository = $repository;
    }

    public function getById($id): Product
    {
        if (null === $this->repository) {
            $this->repository = new ProductRepository(new JustForTestPersistance());
        }

        $this->repository->getById($id);
    }
}
