<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle;


use PagarMe\Sdk\PagarMe;

class ShopChallengePagarmeSDK extends PagarMe implements SDK
{
    public function getRecipient($recipient_id)
    {
        return $this->recipient()->get($recipient_id);
    }
}