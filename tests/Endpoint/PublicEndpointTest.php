<?php

namespace Endpoint;

use GuzzleHttp\Psr7\Response;
use madmis\KunaApi\Client\GuzzleClient;
use madmis\KunaApi\Endpoint\PublicEndpoint;
use PHPUnit\Framework\TestCase;

/**
 * Class PublicEndpointTest
 * @package Endpoint
 */
class PublicEndpointTest extends TestCase
{

    public function testGetTimeout()
    {
        $clientMock = $this->getMockBuilder(GuzzleClient::class)
            ->disableOriginalConstructor()
            ->setMethods(['createRequest', 'send'])
            ->getMock()
        ;

        $clientMock->expects($this->any())
            ->method('send')
            ->will($this->returnValue(new Response(200, [], '10')))
        ;

        $mock = $this->getMockBuilder(PublicEndpoint::class)
            ->setConstructorArgs(['client' => $clientMock])
            ->setMethods(['getApiUrn'])
            ->getMock()
        ;

        $response = $mock->timestamp();
        static::assertSame(10, $response);
    }

    public function testTickers()
    {
        $mock = $this->getMockBuilder(\madmis\KunaApi\Endpoint\PublicEndpoint::class)
            ->disableOriginalConstructor()
            ->setMethods(['sendRequest', 'getApiUrn'])
            ->getMock()
        ;

        $mock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue([
                'at'     => 1111111,
                'ticker' => ["buy" => 10, 'sell' => 20],
            ]))
        ;

        $response = $mock->tickers('usd', false);
        static::assertInternalType('array', $response);
        static::assertEquals(10, $response['ticker']['buy']);

        $response = $mock->tickers('usd', true);
        static::assertInstanceOf(\madmis\KunaApi\Model\Ticker::class, $response);

    }

    public function testOrderBook()
    {
        $mock = $this->getMockBuilder(\madmis\KunaApi\Endpoint\PublicEndpoint::class)
            ->disableOriginalConstructor()
            ->setMethods(['sendRequest', 'getApiUrn'])
            ->getMock()
        ;

        $mock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue([
                'asks' => [['id' => 1]],
                'bids' => [['id' => 2]],
            ]))
        ;

        $response = $mock->orderBook('usd', false);
        static::assertInternalType('array', $response);
        static::assertArrayHasKey('asks', $response);
        static::assertArrayHasKey('bids', $response);

        $response = $mock->orderBook('usd', true);
        static::assertInstanceOf(\madmis\KunaApi\Model\Order::class, $response['bids'][0]);

        $response = $mock->asksOrderBook('usd', true);
        static::assertInstanceOf(\madmis\KunaApi\Model\Order::class, $response[0]);
        static::assertEquals(1, $response[0]->getId());

        $response = $mock->bidsOrderBook('usd', true);
        static::assertInstanceOf(\madmis\KunaApi\Model\Order::class, $response[0]);
        static::assertEquals(2, $response[0]->getId());
    }

    public function testTradesHistory()
    {
        $mock = $this->getMockBuilder(\madmis\KunaApi\Endpoint\PublicEndpoint::class)
            ->disableOriginalConstructor()
            ->setMethods(['sendRequest', 'getApiUrn'])
            ->getMock()
        ;

        $mock->expects($this->any())
            ->method('sendRequest')
            ->will($this->returnValue([['id' => 10]]))
        ;

        $response = $mock->tradesHistory('usd', false);
        static::assertInternalType('array', $response);
        static::assertEquals(10, $response[0]['id']);

        $response = $mock->tradesHistory('usd', true);
        static::assertInstanceOf(\madmis\KunaApi\Model\History::class, $response[0]);

    }
}
