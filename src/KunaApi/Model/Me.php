<?php

namespace madmis\KunaApi\Model;

use JMS\Serializer\Annotation\Type;
use JMS\Serializer\Annotation\AccessType;

/**
 * Class Me
 * @package madmis\KunaApi\Model
 * @AccessType("public_method")
 */
class Me
{
    /**
     * @Type("string")
     * @var string
     */
    protected $email;

    /**
     * @Type("boolean")
     * @var bool
     */
    protected $activated;

    /**
     * @Type("array<madmis\KunaApi\Model\MyAccount>")
     * @var array|MyAccount[]
     */
    protected $accounts;

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return bool
     */
    public function isActivated(): bool
    {
        return $this->activated;
    }

    /**
     * @param bool $activated
     */
    public function setActivated(bool $activated): void
    {
        $this->activated = $activated;
    }

    /**
     * @return array|MyAccount[]
     */
    public function getAccounts(): array
    {
        return $this->accounts;
    }

    /**
     * @param array|MyAccount[] $accounts
     */
    public function setAccounts(array $accounts): void
    {
        $this->accounts = $accounts;
    }
}
