<?php
    /**
     * @package PHP
     * @author Leonam Pereira Dias <leonam.pd@gmail.com>
     */

    namespace Leonam\ShopChallenge\Bundle\Entity\Transaction;

    use PagarMe\Sdk\Card\Card;
    use PagarMe\Sdk\Customer\Customer;
    use PagarMe\Sdk\PagarMe;
    use PagarMe\Sdk\SplitRule\SplitRuleCollection;

class Builder
{
    protected $sdk;

    public function __construct(PagarMe $sdk)
    {
        $this->sdk = $sdk;
    }

    public function build(
        float $total,
        Card $card,
        Customer $customer,
        $installments,
        bool $capture,
        string $urlPostBack,
        SplitRuleCollection $collection = null
    ) {

        if (null === $collection) {
            return $this->sdk->transaction()->creditCardTransaction(
                $total,
                $card,
                $customer,
                $installments,
                $capture,
                $urlPostBack
            );
        }
        return $this->sdk->transaction()->creditCardTransaction(
            $total,
            $card,
            $customer,
            $installments,
            $capture,
            $urlPostBack,
            [],
            ["split_rules" => $collection]
        );
    }
}
