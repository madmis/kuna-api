<?php

namespace Model;

use madmis\KunaApi\Model\Me;
use madmis\KunaApi\Model\MyAccount;
use PHPUnit\Framework\TestCase;

/**
 * Class MeTest
 * @package Model
 */
class MeTest extends TestCase
{
    public function testModel()
    {
        $account1 = new MyAccount();
        $account1->setBalance(1000.1);
        $account1->setCurrency('btc');
        $account1->setLocked(150.8);

        static::assertEquals(1000.1, $account1->getBalance());
        static::assertEquals('btc', $account1->getCurrency());
        static::assertEquals(150.8, $account1->getLocked());

        $account2 = new MyAccount();

        $model = new Me();
        $model->setEmail('email');
        $model->setActivated(false);
        $model->setAccounts([$account1, $account2]);

        static::assertEquals('email', $model->getEmail());
        static::assertFalse($model->isActivated());
        static::assertCount(2, $model->getAccounts());
    }
}