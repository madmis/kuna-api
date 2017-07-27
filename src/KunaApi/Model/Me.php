<?php

namespace madmis\KunaApi\Model;

/**
 * Class Me
 * @package madmis\KunaApi\Model
 */
class Me
{
    /**
     * @var string
     */
    protected $email;

    /**
     * @var bool
     */
    protected $activated;

    /**
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
