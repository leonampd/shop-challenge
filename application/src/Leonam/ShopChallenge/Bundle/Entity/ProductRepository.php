<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity;


class ProductRepository extends Repository
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

    /**
     * Instancia e retorna objs Product para evitar maior complexidade e acesso a banco de dados
     *
     * @return array
     */
    public function getAll(): array
    {
        return $this->persistance->retrieve();
    }

    public function getById(mixed $id): EntityBase
    {
        // TODO: Implement getById() method.
    }

}