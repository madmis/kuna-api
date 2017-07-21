<?php

namespace Client;

use madmis\KunaApi\Client\GuzzleClient;
use madmis\KunaApi\Exception\ClientException;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\RequestInterface;

class GuzzleClientTest extends TestCase
{
    public function testGetOption()
    {
        $client = new GuzzleClient('http://test.com/', '/', ['first' => 1]);

        static::assertEquals(1, $client->getOption('first'));
        static::assertNull($client->getOption('second'));
    }

    public function testCreateRequest()
    {
        $client  = new GuzzleClient('http://test.com/', '/', ['first' => 1]);
        $request = $client->createRequest('GET', '/me');

        static::assertInstanceOf(RequestInterface::class, $request);
    }

    public function testSend()
    {
        $client  = new GuzzleClient('http://test.com/', '/', ['first' => 1]);
        $request = $client->createRequest('GET', '/me');

        try {
            $client->send($request, ['query' => ['test' => 'value']]);
        } catch (ClientException $e) {
            static::assertNotNull($e->getRequest());
            static::assertNotNull($e->getResponse());
        }
    }
}