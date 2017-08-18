<?php
/**
 * @author LeonamDias <leonam.pd@gmail.com>
 * @package PHP
 */

namespace Leonam\ShopChallenge\Bundle\Entity;

class Product implements EntityBase
{
    /**
     * @var int $id
     */
    protected $id;

    /**
     * @var string $slug
     */
    protected $slug;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var string $description
     */
    protected $description;

    /**
     * @var float $value
     */
    protected $value;

    /**
     * @var Leonam\ShopChallenge\Bundle\Entity\Seller $seller
     */
    protected $seller;

    /**
     * @var string $featuredImage
     */
    protected $featuredImage;

    public function __construct(string $name, float $value, Seller $seller)
    {
        $this->name = $name;
        $this->value = $value;
        $this->seller = $seller;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     *
     * @return Product
     */
    public function setId(int $id): Product
    {
        $this->id = $id;

        return $this;
    }

    /**
     * @return string
     */
    public function getSlug(): string
    {
        return $this->slug;
    }

    /**
     * @param string $slug
     *
     * @return Product
     */
    public function setSlug(string $slug): Product
    {
        $this->slug = $slug;

        return $this;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     *
     * @return Product
     */
    public function setName(string $name): Product
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description ?? '';
    }

    /**
     * @param string $description
     *
     * @return Product
     */
    public function setDescription(string $description): Product
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }

    /**
     * @param float $value
     *
     * @return Product
     */
    public function setValue(float $value): Product
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return \Leonam\ShopChallenge\Bundle\Entity\Seller
     */
    public function getSeller(): \Leonam\ShopChallenge\Bundle\Entity\Seller
    {
        return $this->seller;
    }

    /**
     * @param \Leonam\ShopChallenge\Bundle\Entity\Seller $seller
     *
     * @return Product
     */
    public function setSeller(\Leonam\ShopChallenge\Bundle\Entity\Seller $seller
    ): Product
    {
        $this->seller = $seller;

        return $this;
    }

    /**
     * @return string
     */
    public function getFeaturedImage(): string
    {
        return $this->featuredImage ?? '';
    }

    /**
     * @param string $featured_image
     *
     * @return Product
     */
    public function setFeaturedImage(string $featuredImage): Product
    {
        $this->featuredImage = $featuredImage;

        return $this;
    }
}
