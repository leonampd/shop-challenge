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
        $sellerMaria = new Seller('Maria Barros', Seller::MARKETPLACE_OWNER);
        $sellerMaria->setRecipientId('12314');
        $vader = new Product(
            'Fantasia Darth Vader',
            125,
            $sellerMaria
        );
        $vader->setFeaturedImage('http://sm.ign.com/ign_br/screenshot/default/star-wars-darth-vader-sixth-scale-feature-1000763_e72v.jpg')
            ->setId(1);

        $sellerThiago = new Seller('João Thiago Samuel Cavalcanti');
        $sellerThiago->setRecipientId('98764');
        $cafu = new Product(
            'Fantasia Cafú',
            100,
            $sellerThiago
        );
        $cafu->setFeaturedImage('http://admin.mixpalestras.com.br/Palestrantes/photos/Cafu.jpg')
            ->setId(2);

        $sellerCesar = new Seller('César Anthony João Martins');
        $sellerCesar->setRecipientId('9807');
        $cavalo = new Product(
            'Máscara de cavalo',
            150,
            $sellerCesar
        );
        $cavalo->setFeaturedImage('http://s2.glbimg.com/R7FNz8diQIlVxx9SRwjBxpm3T6RGU-y_0n8GSFIZWqdIoz-HdGixxa_8qOZvMp3w/s.glbimg.com/jo/g1/f/original/2012/10/31/horsehead3.jpg')
            ->setId(3);

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