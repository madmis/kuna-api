<?php

namespace madmis\KunaApi\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\AccessType;

/**
 * Class Ticker
 * @package madmis\KunaApi\Model
 * @AccessType("public_method")
 */
class Ticker
{
    /**
     * @Type("integer")
     * @var int
     */
    private $at;

    /**
     * Base currency price for buy
     * @Type("float")
     * @var float
     */
    private $buy;

    /**
     * Base currency price for sell
     * @Type("float")
     * @var float
     */
    private $sell;

    /**
     * The lowest transaction price for 24 hours
     * @Type("float")
     * @var float
     */
    private $low;

    /**
     * The highest transaction price for 24 hours
     * @Type("float")
     * @var float
     */
    private $high;

    /**
     * Last transaction price
     * @Type("float")
     * @var float
     */
    private $last;

    /**
     * Trading volume in base currency for 24 hours
     * @Type("float")
     * @var float
     */
    private $vol;

    /**
     * Total trading amount in quoted currency for 24 hours
     * @Type("float")
     * @var float
     */
    private $price;

    /**
     * @return int
     */
    public function getAt(): int
    {
        return $this->at;
    }

    /**
     * @param int $at
     */
    public function setAt(int $at): void
    {
        $this->at = $at;
    }

    /**
     * @return float
     */
    public function getBuy(): float
    {
        return $this->buy;
    }

    /**
     * @param float $buy
     */
    public function setBuy(float $buy): void
    {
        $this->buy = $buy;
    }

    /**
     * @return float
     */
    public function getSell(): float
    {
        return $this->sell;
    }

    /**
     * @param float $sell
     */
    public function setSell(float $sell): void
    {
        $this->sell = $sell;
    }

    /**
     * @return float
     */
    public function getLow(): float
    {
        return $this->low;
    }

    /**
     * @param float $low
     */
    public function setLow(float $low): void
    {
        $this->low = $low;
    }

    /**
     * @return float
     */
    public function getHigh(): float
    {
        return $this->high;
    }

    /**
     * @param float $high
     */
    public function setHigh(float $high): void
    {
        $this->high = $high;
    }

    /**
     * @return float
     */
    public function getLast(): float
    {
        return $this->last;
    }

    /**
     * @param float $last
     */
    public function setLast(float $last): void
    {
        $this->last = $last;
    }

    /**
     * @return float
     */
    public function getVol(): float
    {
        return $this->vol;
    }

    /**
     * @param float $vol
     */
    public function setVol(float $vol): void
    {
        $this->vol = $vol;
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
}
