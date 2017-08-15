<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Persistance;

use Leonam\ShopChallenge\Bundle\Entity\Product;
use Leonam\ShopChallenge\Bundle\Entity\Seller;

class JustForTestPersistance implements PersistanceBase
{
    public function retrieve()
    {
        $vader = new Product(
            'Fantasia Darth Vader',
            125,
            new Seller('Maria Barros', Seller::MARKETPLACE_OWNER)
        );
        $vader->setFeaturedImage('http://sm.ign.com/ign_br/screenshot/default/star-wars-darth-vader-sixth-scale-feature-1000763_e72v.jpg');

        $cafu = new Product(
            'Fantasia Cafú',
            100,
            new Seller('João Thiago Samuel Cavalcanti')
        );
        $cafu->setFeaturedImage('http://admin.mixpalestras.com.br/Palestrantes/photos/Cafu.jpg');

        $cavalo = new Product(
            'Máscara de cavalo',
            150,
            new Seller('César Anthony João Martins')
        );
        $cavalo->setFeaturedImage('http://s2.glbimg.com/R7FNz8diQIlVxx9SRwjBxpm3T6RGU-y_0n8GSFIZWqdIoz-HdGixxa_8qOZvMp3w/s.glbimg.com/jo/g1/f/original/2012/10/31/horsehead3.jpg');

        return [$vader, $cafu, $cavalo];
    }

    public function persist(mixed $data)
    {
        // TODO: Implement persist() method.
    }

    public function delete()
    {
        // TODO: Implement delete() method.
    }

}