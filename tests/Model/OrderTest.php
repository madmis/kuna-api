<?php

namespace Model;

use madmis\KunaApi\Model\Order;
use PHPUnit\Framework\TestCase;

/**
 * Class OrderTest
 * @package Model
 */
class OrderTest extends TestCase
{
    public function testModel()
    {
        $model = new Order();
        $model->setVolume(10);
        $model->setTradesCount(2);
        $model->setState('wait');
        $model->setSide('buy');
        $model->setRemainingVolume(0);
        $model->setPrice(1000);
        $model->setOrdType('type');
        $model->setMarket('usd');
        $model->setId(1);
        $model->setExecutedVolume(10);
        $date = new \DateTime();
        $model->setCreatedAt($date);
        $model->setAvgPrice(0);

        static::assertEquals(10, $model->getVolume());
        static::assertEquals(2, $model->getTradesCount());
        static::assertEquals('wait', $model->getState());
        static::assertEquals('buy', $model->getSide());
        static::assertEquals(0, $model->getRemainingVolume());
        static::assertEquals(1000, $model->getPrice());
        static::assertEquals('type', $model->getOrdType());
        static::assertEquals('usd', $model->getMarket());
        static::assertEquals(1, $model->getId());
        static::assertEquals(10, $model->getExecutedVolume());
        static::assertEquals($date, $model->getCreatedAt());
        static::assertEquals(0, $model->getAvgPrice());
    }
}
