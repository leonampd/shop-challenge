<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity;

use Leonam\ShopChallenge\Bundle\Persistance\PersistanceBase;

abstract class Repository
{
    protected $persistance;

    public function __construct(PersistanceBase $persistance){
        $this->persistance = $persistance;
    }

    abstract public function save();
    abstract public function update();
    abstract public function delete();
    abstract public function getAll() : array;
    abstract public function getById($id) : EntityBase;
}