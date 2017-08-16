<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity\Customer;

use PagarMe\Sdk\Customer\Customer as PagarMeCustomer;

class Customer extends PagarMeCustomer
{
    public function __construct(array $arrayData = null)
    {
        parent::__construct($arrayData);
    }
}