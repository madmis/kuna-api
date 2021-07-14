<?php

namespace Model;

use cryptopupua\KunaApi\Model\Ticker;
use PHPUnit\Framework\TestCase;

class TickerTest extends TestCase
{
    public function testModel()
    {
        $model = new Ticker();
        $model->setAt(157867);
        $model->setBuy(150);
        $model->setHigh(180);
        $model->setLast(179);
        $model->setLow(147);
        $model->setPrice(1587);
        $model->setSell(200);
        $model->setVol(64646874);

        static::assertEquals(157867, $model->getAt());
        static::assertEquals(150, $model->getBuy());
        static::assertEquals(180, $model->getHigh());
        static::assertEquals(179, $model->getLast());
        static::assertEquals(147, $model->getLow());
        static::assertEquals(1587, $model->getPrice());
        static::assertEquals(200, $model->getSell());
        static::assertEquals(64646874, $model->getVol());
    }

}
