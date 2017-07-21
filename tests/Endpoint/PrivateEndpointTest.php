<?php

class PrivateEndpointTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\MissingOptionsException
     */
    public function testNoOptions()
    {
        $client = new \madmis\KunaApi\Client\GuzzleClient('', '', []);

        new \madmis\KunaApi\Endpoint\PrivateEndpoint($client);
    }

    /**
     * @expectedException \Symfony\Component\OptionsResolver\Exception\InvalidOptionsException
     */
    public function testInvalidTypeOption()
    {
        $client = new \madmis\KunaApi\Client\GuzzleClient('', '', []);

        new \madmis\KunaApi\Endpoint\PrivateEndpoint($client, ['publicKey' => '', 'secretKey' => null]);
    }

    public function testMe()
    {
        $mock = $this->getMockBuilder(\madmis\KunaApi\Endpoint\PrivateEndpoint::class)
            ->disableOriginalConstructor()
            ->setMethods(['sendRequest', 'getApiUrn'])
            ->getMock()
        ;

        $mock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue([
                'email'     => 'email',
                'activated' => true,
                'accounts'  => [
                    [
                        'currency' => 'uah',
                        'balance'  => 1000,
                        'locked'   => 10,
                    ],
                ],
            ]))
        ;

        $response = $mock->me(false);

        static::assertInternalType('array', $response);
        static::assertEquals('email', $response['email']);
        static::assertEquals('uah', $response['accounts'][0]['currency']);

        $response = $mock->me(true);

        static::assertInstanceOf(\madmis\KunaApi\Model\Me::class, $response);
    }

    public function testCreateOrder()
    {
        $mock = $this->getMockBuilder(\madmis\KunaApi\Endpoint\PrivateEndpoint::class)
            ->disableOriginalConstructor()
            ->setMethods(['sendRequest', 'getApiUrn'])
            ->getMock()
        ;

        $mock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue([
                'id'   => 1,
                'side' => 'buy',
            ]))
        ;

        $response = $mock->createBuyOrder('uah', 1, 10, false);
        static::assertInternalType('array', $response);
        static::assertEquals('buy', $response['side']);

        $response = $mock->createSellOrder('uah', 1, 10, false);
        static::assertInternalType('array', $response);
        static::assertEquals('buy', $response['side']);

        $response = $mock->createBuyOrder('uah', 1, 10, true);
        static::assertInstanceOf(\madmis\KunaApi\Model\Order::class, $response);
    }

    public function testCancelOrder()
    {
        $mock = $this->getMockBuilder(\madmis\KunaApi\Endpoint\PrivateEndpoint::class)
            ->disableOriginalConstructor()
            ->setMethods(['sendRequest', 'getApiUrn'])
            ->getMock()
        ;

        $mock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue([
                'id'   => 1,
                'side' => 'buy',
            ]))
        ;

        $response = $mock->cancelOrder(1, false);
        static::assertInternalType('array', $response);
        static::assertEquals(1, $response['id']);

        $response = $mock->cancelOrder(1, true);
        static::assertInstanceOf(\madmis\KunaApi\Model\Order::class, $response);
    }

    public function testActiveOrders()
    {
        $mock = $this->getMockBuilder(\madmis\KunaApi\Endpoint\PrivateEndpoint::class)
            ->disableOriginalConstructor()
            ->setMethods(['sendRequest', 'getApiUrn'])
            ->getMock()
        ;

        $mock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue([
                ['id' => 1, 'side' => 'buy',],
                ['id' => 2, 'side' => 'sell',],
            ]))
        ;

        $response = $mock->activeOrders('usd', false);
        static::assertInternalType('array', $response);
        static::assertCount(2, $response);
        static::assertInternalType('array', $response[0]);

        $response = $mock->activeOrders('usd', true);
        static::assertInternalType('array', $response);
        static::assertCount(2, $response);
        static::assertInstanceOf(\madmis\KunaApi\Model\Order::class, $response[0]);
    }

    public function testMyHistory()
    {
        $mock = $this->getMockBuilder(\madmis\KunaApi\Endpoint\PrivateEndpoint::class)
            ->disableOriginalConstructor()
            ->setMethods(['sendRequest', 'getApiUrn'])
            ->getMock()
        ;

        $mock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue([
                ['id' => 1, 'price' => 10,],
                ['id' => 2, 'price' => 20,],
            ]))
        ;

        $response = $mock->myHistory('usd', false);
        static::assertInternalType('array', $response);
        static::assertCount(2, $response);
        static::assertInternalType('array', $response[0]);

        $response = $mock->myHistory('usd', true);
        static::assertInternalType('array', $response);
        static::assertCount(2, $response);
        static::assertInstanceOf(\madmis\KunaApi\Model\History::class, $response[0]);
    }
}

\Doctrine\Common\Annotations\AnnotationRegistry::registerLoader('class_exists');