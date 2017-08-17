<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity;


class Seller implements EntityBase
{
    public const MARKETPLACE_OWNER = true;

    /**
     * @var string
     */
    protected $recipient_id;

    /**
     * @var string
     */
    protected $name;

    /**
     * Define se o obj e o dono do marketplace
     *
     * @var bool
     */
    protected $marketPlaceOwner;

    public function __construct(string $name, bool $owner = false)
    {
        $this->name = $name;
        $this->marketPlaceOwner = $owner;
    }

    /**
     * retornar true/false se o seller for ou não dono do market place
     *
     * @return bool
     */
    public function isMarketPlaceOwner()
    {
        return $this->marketPlaceOwner;
    }

    /**
     * @return string
     */
    public function getRecipientId(): string
    {
        return $this->recipient_id ?? '';
    }

    /**
     * @param string $recipient_id
     */
    public function setRecipientId(string $recipient_id)
    {
        $this->recipient_id = $recipient_id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name ?? '';
    }
}