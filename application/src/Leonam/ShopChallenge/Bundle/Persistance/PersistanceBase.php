<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Persistance;


interface PersistanceBase
{
    public function retrieve();
    public function persist(mixed $data);
    public function delete();
}