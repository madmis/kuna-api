<?php

namespace madmis\KunaApi\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\AccessType;

/**
 * Class History
 * @package madmis\KunaApi\Model
 * @AccessType("public_method")
 */
class History
{
    /**
     * Order id
     * @Type("integer")
     * @var int
     */
    private $id;

    /**
     * Price for base currency
     * @Type("float")
     * @var float
     */
    private $price;

    /**
     * Volume in base currency
     * @Type("float")
     * @var float
     */
    private $volume;

    /**
     * Volume in quote currency
     * @Type("float")
     * @var float
     */
    private $funds;

    /**
     * Trade pair
     * @Type("string")
     * @var string
     */
    private $market;

    /**
     * Order time
     * @Type("DateTime<'Y-m-d\TH:i:sP'>")
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Always null
     * @Type("string")
     * @var string
     */
    private $side;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getVolume(): float
    {
        return $this->volume;
    }

    /**
     * @param float $volume
     */
    public function setVolume(float $volume): void
    {
        $this->volume = $volume;
    }

    /**
     * @return float
     */
    public function getFunds(): float
    {
        return $this->funds;
    }

    /**
     * @param float $funds
     */
    public function setFunds(float $funds): void
    {
        $this->funds = $funds;
    }

    /**
     * @return string
     */
    public function getMarket(): string
    {
        return $this->market;
    }

    /**
     * @param string $market
     */
    public function setMarket(string $market): void
    {
        $this->market = $market;
    }

    /**
     * @return \DateTime
     */
    public function getCreatedAt(): \DateTime
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTime $createdAt
     */
    public function setCreatedAt(\DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return string|null
     */
    public function getSide(): ?string
    {
        return $this->side;
    }

    /**
     * @param string|null $side
     */
    public function setSide(string $side = null): void
    {
        $this->side = $side;
    }
}
