<?php

namespace Model;

use cryptopupua\KunaApi\Model\History;
use PHPUnit\Framework\TestCase;

class HistoryTest extends TestCase
{
    public function testModel()
    {
        $model = new History();
        $model->setId(1);
        $model->setFunds(10);
        $model->setCreatedAt('2017-07-27T08:57:27+03:00');
        $model->setMarket('usd');
        $model->setPrice(1000);
        $model->setSide('sell');
        $model->setVolume(0.01);


        static::assertEquals(1, $model->getId());
        static::assertEquals(10, $model->getFunds());
        static::assertEquals(
            new \DateTime('2017-07-27T08:57:27+03:00'),
            $model->getCreatedAt()
        );
        static::assertEquals('usd', $model->getMarket());
        static::assertEquals(1000, $model->getPrice());
        static::assertEquals('sell', $model->getSide());
        static::assertEquals(0.01, $model->getVolume());
    }
}