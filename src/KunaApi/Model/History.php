<?php

namespace madmis\KunaApi\Model;

/**
 * Class History
 * @package madmis\KunaApi\Model
 */
class History
{
    /**
     * Order id
     * @var int
     */
    private $id;

    /**
     * Price for base currency
     * @var float
     */
    private $price;

    /**
     * Volume in base currency
     * @var float
     */
    private $volume;

    /**
     * Volume in quote currency
     * @var float
     */
    private $funds;

    /**
     * Trade pair
     * @var string
     */
    private $market;

    /**
     * Order time
     * @var \DateTime
     */
    private $createdAt;

    /**
     * Always null
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
     * @param string $createdAt
     */
    public function setCreatedAt(string $createdAt): void
    {
        $this->createdAt = new \DateTime($createdAt);
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
