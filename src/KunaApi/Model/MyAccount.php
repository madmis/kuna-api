<?php

namespace madmis\KunaApi\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\AccessType;

/**
 * Class MyAccount
 * @package madmis\KunaApi\Model
 * @AccessType("public_method")
 */
class MyAccount
{
    /**
     * @Type("string")
     * @var string
     */
    protected $currency;

    /**
     * Account balance
     * @Type("float")
     * @var float
     */
    private $balance;

    /**
     * Locked amount
     * @Type("float")
     * @var float
     */
    private $locked;

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

    /**
     * @return float
     */
    public function getBalance(): float
    {
        return $this->balance;
    }

    /**
     * @param float $balance
     */
    public function setBalance(float $balance): void
    {
        $this->balance = $balance;
    }

    /**
     * @return float
     */
    public function getLocked(): float
    {
        return $this->locked;
    }

    /**
     * @param float $locked
     */
    public function setLocked(float $locked): void
    {
        $this->locked = $locked;
    }
}
