<?php


class KunaApiTest extends \PHPUnit\Framework\TestCase
{
    /**
     * @expectedException TypeError
     */
    public function testSetClient()
    {
        $api = new \cryptopupua\KunaApi\KunaApi('http://localhost', 'pub', 'sec');

        $api->setClient(new \GuzzleHttp\Client([]));
    }

    public function testGetClient()
    {
        $api = new \cryptopupua\KunaApi\KunaApi('http://localhost', 'pub', 'sec');

        $this->assertInstanceOf(
            \madmis\ExchangeApi\Client\GuzzleClient::class,
            $api->getClient()
        );

        $mock = $this->createMock(\madmis\ExchangeApi\Client\ClientInterface::class);
        $api->setClient($mock);
        $this->assertInstanceOf(
            \madmis\ExchangeApi\Client\ClientInterface::class,
            $api->getClient()
        );
    }

    public function testGetShared()
    {
        $api = new \cryptopupua\KunaApi\KunaApi('http://localhost', 'pub', 'sec');

        $this->assertInstanceOf(
            \cryptopupua\KunaApi\Endpoint\PublicEndpoint::class,
            $api->shared()
        );
    }

    public function testGetSigned()
    {
        $api = new \cryptopupua\KunaApi\KunaApi('http://localhost', 'pub', 'sec');

        $this->assertInstanceOf(
            \cryptopupua\KunaApi\Endpoint\PrivateEndpoint::class,
            $api->signed()
        );
    }
}